<?php
    include 'config.php';
    
    $error_msg = array();
    $success_msg = array();
    
    // open connection to DB
    $connection = pg_connect('host=' .$host. ' port=' .$port. ' dbname=' .$database. ' user=' .$user. ' password=' .$password) 
        or die("DB ERROR: connect failed!");
        
    // DROP TABLE query
    $drop_tables = array();
    $drop_tables['LOG'] = 'DROP TABLE LOG';
    $drop_tables['URL'] = 'DROP TABLE URL';
    $drop_tables['REFERRER'] = 'DROP TABLE REFERRER';
    $drop_tables['PLATFORM'] = 'DROP TABLE PLATFORM';
    $drop_tables['BROWSER'] = 'DROP TABLE BROWSER';
    
    // execute queries
    foreach ($drop_tables as $table_name => $query) {
        $result = pg_query($query);
        if ($result) {
            $success_msg[] = 'Drop table ' .$table_name. ' was successfull. <br>';
        } else {
            $error_msg[] = 'Drop table ' .$table_name. ' failed: ' .pg_last_error() . '<br>';
        }
    }
    
    // print all messages
    print_r($success_msg);
    print_r($error_msg);
    
    // close connection to DB
    pg_close($connection);
?>