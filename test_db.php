<?php
    include 'config.php';
    
    // open connection to DB
    $connection = pg_connect('host=' .$host. ' port=' .$port. ' dbname=' .$database. ' user=' .$user. ' password=' .$password) 
        or die("DB ERROR: connect failed!");
        
    // execute a SQL query for URL
    $query = 'SELECT * FROM URL';
    $result = pg_query($query) or die('Executing query failed: ' .pg_last_error());
    
    // print results in HTML
    echo "<h2>Table URL:</h2>\n";
    echo "<table>\n";
    while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $column_value) {
            echo "\t\t<td>$column_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // execute a SQL query for LOG
    $query = 'SELECT * FROM LOG';
    $result = pg_query($query) or die('Executing query failed: ' .pg_last_error());
    
    // print results in HTML
    echo "<h2>Table LOG:</h2>\n";
    echo "<table>\n";
    while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $column_value) {
            echo "\t\t<td>$column_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // execute a SQL query for REFERRER
    $query = 'SELECT * FROM REFERRER';
    $result = pg_query($query) or die('Executing query failed: ' .pg_last_error());
    
    // print results in HTML
    echo "<h2>Table REFERRER:</h2>\n";
    echo "<table>\n";
    while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $column_value) {
            echo "\t\t<td>$column_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // execute a SQL query for PLATFORM
    $query = 'SELECT * FROM PLATFORM';
    $result = pg_query($query) or die('Executing query failed: ' .pg_last_error());
    
    // print results in HTML
    echo "<h2>Table PLATFORM:</h2>\n";
    echo "<table>\n";
    while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $column_value) {
            echo "\t\t<td>$column_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // execute a SQL query for BROWSER
    $query = 'SELECT * FROM BROWSER';
    $result = pg_query($query) or die('Executing query failed: ' .pg_last_error());
    
    // print results in HTML
    echo "<h2>Table BROWSER:</h2>\n";
    echo "<table>\n";
    while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $column_value) {
            echo "\t\t<td>$column_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    // close connection to DB
    pg_close($connection);
?>