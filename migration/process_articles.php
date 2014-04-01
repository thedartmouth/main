<?php

/*
 * Process articles
 *
 * Pulls article out of quarantine, reformats it, adds authors as users, adds to search index queue, etc
 *
 */
 
require_once '../configure.php';
require_once '../utilities.php';
require_once 'utilities.php';

// Check to make sure the logged-in user is allowed access to the migration scripts
if(!is_migration_user()){
    exit;
}

// Get DB connection objects
$cxn = get_database_cxn();
$cxn_legacy = get_database_cxn_legacy();

// Define table names
$posts_table_name = DB_PREFIX.'posts';
$tmp_posts_table_name = TMP_PREFIX.$posts_table_name;
$meta_table_name = DB_PREFIX.'postmeta';
$tmp_meta_table_name = TMP_PREFIX.$meta_table_name;


// Check to see if there are unprocessed items in the quarantine
$query = "select count(*) as number_of_articles, min(uid)  as min_post_id, max(uid)  as max_post_id from $tmp_posts_table_name limit 1";
$result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
$row = mysqli_fetch_assoc($result);
if ($row != false){
    extract($row);
    // If there are items in the queue, proceed
    if($number_of_articles > 0){
        $posts_inserted = 0;
        $default_length = 1;
        $length = (isset($_GET['length']) ? intval($_GET['length']) : $default_length);
        $counter = $min_post_id;
        $max_counter = ((($min_post_id + $length - 1) > $max_post_id) ? $max_post_id : $min_post_id + $length - 1);
        while($counter <= $max_counter){
            // Pull item from quarantine
            $query = "select * from $tmp_posts_table_name where uid = $counter limit 1";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            $row = mysqli_fetch_assoc($result);
            if ($row != false){
                $post_id = $row['ID'];
                $sep = ''; 
                $fields = ''; 
                $values = ''; 
                while(list($field, $value) = each($row)){
                    if($field != 'uid'){
                    // Process hash_id field
                    if($field == 'hash_id'){
                        $value = random_string(25);
                        $hash_id = $value;
                    }
                    // Process guid field
                    if($field == 'guid'){
                        $value = replace_old_server_references($value);  
                    }
                    
                    // Process post_title
                    if($field == 'post_title'){
                        $post_title = $value;
                    }
                    
                    // Process post content
                    if($field == 'post_content'){
                        $post_content_pre_processing = $value;
                        $value = replace_old_server_references($value);
                        if($post_id < 32716){
                            $value = convert_from_markdown($value);
                        } else {
                            $value = convert_from_markdown($value, true);                               
                        }
                        $value = remove_legacy_characters($value);
                        $value = add_line_endings($value);
                        $value = post_markdown_formatting($value); 
                        $post_content = $value;
                    }
                    
                    // Process post content
                    if($field == 'post_content_pre_processing'){
                        $value = $post_content_pre_processing;
                    }
                    
                    // Create author and associate them to the article
                    if($field == 'post_author'){
                        $author_hash_id = create_author($value);
                        associate_author_to_article($hash_id, $author_hash_id);
                    }
                    
                        
                    $fields .= $sep . "`" . $field . "`"; 
                    $values .= $sep . "'" . mysqli_real_escape_string($cxn, $value) . "'"; 
                    $sep = ",";
                    }
                }
            // Insert new data in posts table
            $query = "insert into $posts_table_name ($fields) values ($values) ON DUPLICATE KEY UPDATE ID=ID";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            // Delete from quarantine
            $query = "delete from $tmp_posts_table_name where uid = $counter limit 1";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            // Send to indexing queue
            # send_article_to_index_queue($hash_id, $post_title.' '.$post_content, null);
            
            $posts_inserted++;
            }          
            $counter++;   
        }
        $query = "select count(*) as number_of_articles from $tmp_posts_table_name limit 1";
        $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
        $row = mysqli_fetch_assoc($result);
        if ($row != false){
            extract($row);
        }        

        $response['type'] = 'success';
        $response['data']['posts_inserted'] = $posts_inserted;
        $response['data']['posts_left'] = $number_of_articles;
        
    } else {
        $response['type'] = 'success';
        $response['message'] = 'No posts in the quarantine table';
        $response['data']['posts_inserted'] = 0;
        $response['data']['posts_left'] = 0;
    }
} else {
    $response['message'] = 'Could not determine if there were any rows in quarantine table'; 
}

include 'output_json.php';
