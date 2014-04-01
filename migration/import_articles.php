<?php

/*
 * Import articles
 *
 * Connects to legacy server, imports all articles into quarantine
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
$table_name = DB_PREFIX.'posts';
$tmp_table_name = TMP_PREFIX.$table_name;
$meta_table_name = DB_PREFIX.'postmeta';
$tmp_meta_table_name = TMP_PREFIX.$meta_table_name;
$author_associations_table_name = DB_PREFIX.'posts_authors';
$users_table_name = DB_PREFIX.'users';
$users_meta_table_name = DB_PREFIX.'usermeta';
$tmp_users_table_name = TMP_PREFIX.$users_table_name;
$tmp_users_meta_table_name = TMP_PREFIX.$users_meta_table_name;


// Check to see if there are already unprocessed items in the quarantine
$query = "select count(*) as number_of_items from $tmp_table_name limit 1";
$result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
$row = mysqli_fetch_assoc($result);
if ($row != false){
    extract($row);
    if($number_of_items == 0 || (isset($_GET['force']) && $_GET['force'] == 'true')){
        
        // Pull minimum and maximum post ID #
        $query = "select max(ID) as max_id, min(ID) as min_id , count(*) as number_of_legacy from $table_name limit 1";
        $result = mysqli_query($cxn_legacy, $query) or die(mysqli_error($cxn_legacy).'Query: '.$query);
        $row = mysqli_fetch_assoc($result);
        if ($row != false){
            extract($row);
            $real_max_id = $max_id;
            $real_min_id = $min_id;
            $rows_inserted = 0;
            
            // Empty the quarantine if necessary
            if(isset($_GET['truncate']) && $_GET['truncate'] == 'true'){
                #empty users (except admin)
                $query = "delete from $users_table_name where ID != '1'";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                                             
                #empty user meta (except admin)
                $query = "delete from $users_meta_table_name where user_id != '1'";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                
                #empty tmp users 
                $query = "truncate table $tmp_users_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                                             
                #empty tmp user meta
                $query = "truncate table $tmp_users_meta_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);                
                                              
                #empty author-associations
                $query = "truncate table $author_associations_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                                
                #empty real posts
                $query = "truncate table $table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                
                #empty tmp posts
                $query = "truncate table $tmp_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);

                #empty postmeta
                $query = "truncate table $meta_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                
                #empty tmp postmeta
                $query = "truncate table $tmp_meta_table_name";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                
                #refill tmp postmeta
                $query = "select max(meta_id) as max_meta, min(meta_id) as min_meta , count(*) as number_of_meta from $meta_table_name limit 1";
                $result = mysqli_query($cxn_legacy, $query) or die(mysqli_error($cxn_legacy).'Query: '.$query);
                $row = mysqli_fetch_assoc($result);
                if ($row != false){
                    extract($row);
                    $meta_inserted = 0;
                    $meta_counter = $min_meta;
                    while($meta_counter <= $max_meta){
                        $query = "select * from $meta_table_name where meta_id = $meta_counter limit 1";
                        $result = mysqli_query($cxn_legacy, $query) or die(mysqli_error($cxn_legacy).'Query: '.$query);
                        $row = mysqli_fetch_assoc($result);
                        if ($row != false){ 
                            $sep = ''; 
                            $fields = ''; 
                            $values = ''; 
                            while(list($field, $value) = each($row)){ 
                                $fields .= $sep . "`" . $field . "`"; 
                                $values .= $sep . "'" . mysqli_real_escape_string($cxn, $value) . "'"; 
                                $sep = ","; 
                            }  
                        $query = "insert into $tmp_meta_table_name ($fields) values ($values) ON DUPLICATE KEY UPDATE meta_id=meta_id";
                        $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                        $meta_inserted++;
                        }
                        $meta_counter++;                        
                    }
                    
                }
                

                
            
            }
            // If 'starting_at' id number has been passed, set counter to that
            $min_id = (isset($_GET['starting_at']) ? intval($_GET['starting_at']) : $min_id);
            
            // If length has been set, use that to set max number
            $max_id = (isset($_GET['length']) ? intval($_GET['length']) + $min_id - 1 : $max_id);
        
            
            // Cycle through posts, pulling them into new quarantine
            $counter = $min_id;
            while($counter <= $max_id){
                $query = "select * from $table_name where ID = $counter limit 1";
                $result = mysqli_query($cxn_legacy, $query) or die(mysqli_error($cxn_legacy).'Query: '.$query);
                $row = mysqli_fetch_assoc($result);
                if ($row != false){ 
                    $sep = ''; 
                    $fields = ''; 
                    $values = ''; 
                    while(list($field, $value) = each($row)){ 
                        $fields .= $sep . "`" . $field . "`"; 
                        $values .= $sep . "'" . mysqli_real_escape_string($cxn, $value) . "'"; 
                        $sep = ",";
                        // Grab author_id, import author data into quarantine
                        if($field == 'post_author'){
                            $author_id = $value;
                            // Pull user data                           
                            $query_1 = "select * from $users_table_name where ID = $author_id limit 1";
                            $result_1 = mysqli_query($cxn_legacy, $query_1) or die(mysqli_error($cxn_legacy).'Query: '.$query_1);
                            $row_1 = mysqli_fetch_assoc($result_1);
                            if ($row_1 != false){ 
                                $sep_1 = ''; 
                                $fields_1 = ''; 
                                $values_1 = '';
                                while(list($field_1, $value_1) = each($row_1)){ 
                                    $fields_1 .= $sep_1 . "`" . $field_1 . "`"; 
                                    $values_1 .= $sep_1 . "'" . mysqli_real_escape_string($cxn, $value_1) . "'"; 
                                    $sep_1 = ",";
                                }  
                            $query_1_a = "insert into $tmp_users_table_name ($fields_1) values ($values_1) ON DUPLICATE KEY UPDATE ID=ID";
                            $result_1_a = mysqli_query($cxn, $query_1_a) or die(mysqli_error($cxn).'Query: '.$query_1_a);
                            }                                
                            // Pull user meta
                            $query_2 = "select * from $users_meta_table_name where user_id = $author_id";
                            $result_2 = mysqli_query($cxn_legacy, $query_2) or die(mysqli_error($cxn_legacy).'Query: '.$query_2);
                            while($row_2 = mysqli_fetch_assoc($result_2)){                          
                                $sep_2 = ''; 
                                $fields_2 = ''; 
                                $values_2 = '';
                                while(list($field_2, $value_2) = each($row_2)){ 
                                    $fields_2 .= $sep_2 . "`" . $field_2 . "`"; 
                                    $values_2 .= $sep_2 . "'" . mysqli_real_escape_string($cxn, $value_2) . "'"; 
                                    $sep_2 = ",";
                                }  
                                $query_2_a = "insert into $tmp_users_meta_table_name ($fields_2) values ($values_2) ON DUPLICATE KEY UPDATE umeta_id=umeta_id";
                                $result = mysqli_query($cxn, $query_2_a) or die(mysqli_error($cxn).'Query: '.$query_2_a);
                            }
                        }
                    }  
                $query = "insert into $tmp_table_name ($fields) values ($values) ON DUPLICATE KEY UPDATE ID=ID";
                $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                $rows_inserted++;
                }
                $counter++;
            }
            
            $query = "select count(*) as number_of_items from $tmp_table_name limit 1";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            $row = mysqli_fetch_assoc($result);
            if ($row != false){
                extract($row);
            }
            $query = "select count(*) as total_processed from $table_name limit 1";
            $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            $row = mysqli_fetch_assoc($result);
            if ($row != false){
                extract($row);
            }
            $response['type'] = 'success';
            $response['data']['rows_inserted'] = $rows_inserted;          
            $response['data']['id_started'] = $min_id;
            $response['data']['id_ended'] = $max_id;
            $response['data']['real_min'] = $real_min_id;
            $response['data']['real_max'] = $real_max_id;
            $response['data']['remaining'] = (($real_max_id >= $max_id) ? $real_max_id - $max_id : 0);            
            $response['data']['total_tmp'] = $number_of_items;
            $response['data']['total_processed'] = $total_processed;
            $response['data']['total_legacy'] = $number_of_legacy;
            $response['data']['is_synced'] = (($number_of_items + $total_processed >= $number_of_legacy) ? 'true' : 'false');
            if(isset($meta_inserted)){
                $response['data']['meta_rows_inserted'] = $meta_inserted;  
            }
            
        } else {
           $response['message'] = 'Could not determine min(id) or max(id) of legacy table'; 
        }
    } else {
        $response['message'] = 'Tmp table is not empty';   
    }
} else {
    $response['message'] = 'Could not determine if there were any rows in quarantine table'; 
}

include 'output_json.php';
