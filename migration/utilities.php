<?php

/*
 * Migration utilities file
 *
 * Defines useful functions used in the other migration scripts
 *
 */
 
require_once '../configure.php';

// Check to see if user is allowed access to the migration scripts
function is_migration_user(){
    $return = true;
    // Fill in with logic to check if user is admin
    return $return;
}


// Strip out references to old server
function replace_old_server_references($string = ''){
   $string =  str_replace('http://bwcproductions.com/thed/',DIR_WS_ROOT,$string);
   $string =  str_replace('/thed/',DIR_WS_RELATIVE_BASE,$string);
   $stripped_root = str_replace('http://','',DIR_WS_ROOT);
   $stripped_root = str_replace(DIR_WS_RELATIVE_BASE,'',$stripped_root);
   $string =  str_replace('bwcproductions.com',$stripped_root,$string);   
   return $string;
}

// Convert from markdown to html
function convert_from_markdown($string = '', $later = false){
    include_once "markdown.php";
    // Strip line breaks from within img tags
    $string = preg_replace_callback(
            '/<img(.*?)\>/s',
            function ($replace) {
                return preg_replace('~(*BSR_ANYCRLF)\R~', "", $replace[0]);
            },
            $string
        );
    
    // Replace non utf quotes with good ones
    $string = str_replace('Ò', '&quot;', $string);
    $string = str_replace('Ó', '&quot;', $string);    
    
    // Format line endings
    $string = preg_replace('~(*BSR_ANYCRLF)\R~', "\r\n", $string);
    $string = "\r\n".$string;
    
    // Format h3
    $string = str_replace("\r\n".'**',"\r\n".'###**', $string);
    $string = str_replace('**'."\r\n",'**###'."\r\n\r\n", $string);

    // Format h2
    $string = str_replace("\r\n".'*',"\r\n".'##**', $string);
    $string = str_replace('*'."\r\n",'**##'."\r\n\r\n", $string);
    
    // Format p
    if($later){
        $string = str_replace("\r\n".'	',"\r\n\r\n\r\n", $string);
    } else {
        $string = str_replace("\r\n".'	',' ', $string);
    }
    $string = str_replace('     ',"\r\n", $string);
    
    // Pass to markdown parser
    $string = Markdown($string);
   
   return $string;
}


// Add line endings after block-level html elements
function add_line_endings($string = ''){
    $n = "\r\n";
    
    // Format line endings
    $string = str_replace('</p>', '</p>'.$n, $string);
    $string = str_replace('</div>','</div>'.$n, $string);
    $string = str_replace('</h3>','</h3>'.$n, $string);
    $string = str_replace('</h2>','</h2>'.$n, $string);
    $string = str_replace('</h1>','</h1>'.$n, $string);

   return $string;
}

// Post-markdown reformatting
function post_markdown_formatting($string = ''){
    
    // Fix <strong> quirk
    $string = str_replace('<strong>', '', $string);
    $string = str_replace('</strong>', '', $string);
    
   return $string;
}

// Remove legacy (non-utf8) characters
function remove_legacy_characters($string = ''){
    $string = preg_replace('/[^(\x20-\x7F)]*/','', $string);      
   return $string;
}

// Send article/post to the AWS SQS queue for indexing later
function send_article_to_index_queue($hash_id, $string, $last_string = null){
    #get article Id
    $cxn = get_database_cxn();
    $table_name = DB_PREFIX.'posts';
    $query = "select ID as post_id from $table_name where hash_id = '$hash_id' limit 1";
    $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
    $row = mysqli_fetch_assoc($result);
    if ($row != false){
        extract($row);
        $string = str_replace("\r\n", ' ', $string);
        $string = strip_tags($string);
        $string = trim(preg_replace("/[^a-zA-Z0-9\s]/","", $string));
        $string = preg_replace('~(*BSR_ANYCRLF)\R~', "", $string);
        $string_array = explode(' ', $string);
        $useable_words = array();
        require_once '../search/helpers.php';
        foreach($string_array as $snippet){
            $snippet = (string)$snippet;
            $snippet = trim($snippet);
            if(word_should_be_filtered($snippet) == false){
                $useable_words[] = strtolower($snippet);   
            }
        }
        if(count($useable_words) > 0){
            $string_csv = implode(',',$useable_words);
            $string_csv_old = '';
            #Send to SQS
            require_once '../search/sdk.class.php';
            $sqs = new AmazonSQS();
            $queue_message = $post_id.':'.$string_csv.':'.$string_csv_old;
            $sendMessageResponse = $sqs->send_message(AWS_INDEX_QUEUE, $queue_message);
        }
    }
}

// Create author if they do not exist yet
function create_author($legacy_id){
    // Grab user details from quarantine
    $new_hash_id = null;
    $cxn = get_database_cxn();
    $query = "select hash_id as new_hash_id from wp_users where ID = $legacy_id limit 1";
    $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
    $row = mysqli_fetch_assoc($result);
    if ($row != false){
        extract($row);
    } else {
        // Migrate user
        $query = "select ID, user_login, user_pass, user_nicename, user_email, user_registered, display_name from quarantine_wp_users where ID = $legacy_id limit 1";
        $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
        $row = mysqli_fetch_assoc($result);
        if ($row != false){
            $new_hash_id = random_string(25);
            $row['hash_id'] = $new_hash_id;
            $sep = ''; 
            $fields = ''; 
            $values = ''; 
            while(list($field, $value) = each($row)){ 
                $fields .= $sep . "`" . $field . "`"; 
                $values .= $sep . "'" . mysqli_real_escape_string($cxn, $value) . "'"; 
                $sep = ","; 
            }  
            $query = "insert into wp_users ($fields) values ($values) ON DUPLICATE KEY UPDATE ID=ID";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            // Migrate user profile
            $query = "select umeta_id, user_id, meta_key, meta_value from quarantine_wp_usermeta where user_id = $legacy_id";
            $result2 = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            while($row = mysqli_fetch_assoc($result2)){
                $sep = ''; 
                $fields = ''; 
                $values = ''; 
                while(list($field, $value) = each($row)){ 
                    $fields .= $sep . "`" . $field . "`"; 
                    $values .= $sep . "'" . mysqli_real_escape_string($cxn, $value) . "'"; 
                    $sep = ","; 
                }  
                $query = "insert into wp_usermeta ($fields) values ($values) ON DUPLICATE KEY UPDATE user_id=user_id";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);              
            }
        }
    }

    return $new_hash_id;
}

// Associate an author with an article
function associate_author_to_article($article_hash_id, $author_hash_id){
    $cxn = get_database_cxn();
    $table_name = DB_PREFIX.'posts_authors';
    $query = "select ID from $table_name where post_hash_id = '$article_hash_id' AND author_hash_id = '$author_hash_id' limit 1";
    $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
    $row = mysqli_fetch_assoc($result);
    if ($row == false){
        $query = "insert into $table_name (post_hash_id, author_hash_id) values ('$article_hash_id', '$author_hash_id')";
        $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);          
    }
  
}