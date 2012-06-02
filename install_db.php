<?php 
	include 'config.php';
    
    $error_msg = array();
    $success_msg = array();
    
	// open connection to DB
	$connection = pg_connect('host=' .$host. ' port=' .$port. ' dbname=' .$database. ' user=' .$user. ' password=' .$password) 
		or die("DB ERROR: connect failed!");
	
	// CREATE TABLE query
	$create_tables = array();
	$create_tables['URL'] =
		'CREATE TABLE IF NOT EXISTS URL(
			url_id serial PRIMARY KEY,
			longurl varchar(200) NOT NULL,
			shorturl varchar(40),
			title varchar(200),
			datetime timestamp DEFAULT CURRENT_TIMESTAMP,
			ip cidr NOT NULL,
			click_count integer DEFAULT 0)';
	
	$create_tables['REFERRER'] = 
		'CREATE TABLE IF NOT EXISTS REFERRER(
			referrer_id serial PRIMARY KEY,
			url varchar(200) NOT NULL,
			host varchar(50) NOT NULL)';
			
	$create_tables['PLATFORM'] = 
		'CREATE TABLE IF NOT EXISTS PLATFORM(
			platform_id serial PRIMARY KEY,
			platform varchar(50) NOT NULL)';
			
	$create_tables['BROWSER'] = 
		'CREATE TABLE IF NOT EXISTS BROWSER(
			browser_id serial PRIMARY KEY,
			browser varchar(50) NOT NULL)';
			
	$create_tables['LOG'] = 
		'CREATE TABLE IF NOT EXISTS LOG(
			log_id serial PRIMARY KEY,
			url_id integer REFERENCES URL (url_id),
			clicktime timestamp DEFAULT CURRENT_TIMESTAMP,
			referrer_id integer REFERENCES REFERRER (referrer_id),
			platform_id integer REFERENCES PLATFORM (platform_id),
			browser_id integer REFERENCES BROWSER (browser_id),
			country_code CHAR(2))';
			
	$create_table_counter = 0;
	
	// execute queries
	foreach ($create_tables as $table_name => $query) {
		$result = pg_query($query);
		if ($result) {
			$create_table_counter++;
            $success_msg[] = 'Table ' .$table_name. ' created. <br>';
		} else {
		    $error_msg[] = 'Error creating table ' .$table_name. '.' .pg_last_error(). '<br>';
		}
	}

    $create_tables_success = FALSE;
    
    // check results of operations
    if (sizeof($create_tables) == $create_table_counter) {
        $success_msg[] = 'All tables successfully created. <br>';
        $create_tables_success = TRUE;
    } else {
        $error_msg[] = 'Error creating CatrobatURLSS tables. <br>';
    }
	
    // INSERT TABLE query
    if ($create_tables_success) {
        $insert_tables = array();
        $insert_tables['URL'] = 
            "INSERT INTO URL (longurl, shorturl, title, datetime, ip, click_count) VALUES
                ('http://www.php.net/manual/de/pgsql.examples-basic.php', '0001', 'PHP: Grundlegende Nutzung - Manual', '2012-05-20 08:07:13', '192.168.100.128/25', 2),
                ('http://www.php-einfach.de/codeschnipsel_8566.php', '0002', 'PHP-Einfach.de - Herkunft einer IP-Adresse ermitteln. (IP to Country)', '2012-04-20 10:12:43', '127.0.0.1', 4),
                ('http://yourls.com', '000a', 'YOURLS: Your Own URL Shortener', '2012-04-28 20:34:09', '192.168.50.1', 3),
                ('https://www.facebook.com', '0B2x', 'Willkommen bei Facebook - anmelden, registrieren oder mehr erfahren', '2012-05-28 15:29:41', '127.0.0.1', 1)";
           
        $insert_tables['REFERRER'] = 
            "INSERT INTO REFERRER (url, host) VALUES
                ('http://twitter.com/', 'twitter.com'),
                ('http://twitter.com/ArminWolf', 'twitter.com'),
                ('http://google.com/search', 'google.com')";
                
        $insert_tables['PLATFORM'] = 
            "INSERT INTO PLATFORM (platform) VALUES
                ('Windwos XP'),
                ('Windows Vista'),
                ('Windows 7'),
                ('Mac OS'),
                ('Linux')";
        
        $insert_tables['BROWSER'] =
            "INSERT INTO BROWSER (browser) VALUES
                ('Internet Explorer'),
                ('Mozilla Firefox'),
                ('Opera'),
                ('Safari'),
                ('Google Chrome')";
        
        $insert_tables['LOG'] = 
            "INSERT INTO LOG (url_id, clicktime, referrer_id, platform_id, browser_id, country_code) VALUES
                (1, '2012-05-20 10:15:23', 1, 3, 1, 'AT'),
                (1, '2012-05-20 18:09:13', 2, 4, 4, 'AT'),
                (2, '2012-04-23 10:15:23', 1, 5, 3, 'DE'),
                (2, '2012-04-25 10:15:23', 3, 1, 2, 'SE'),
                (2, '2012-04-25 10:15:23', 3, 2, 1, 'AT'),
                (2, '2012-05-03 10:15:23', 3, 4, 5, 'AT'),
                (3, '2012-04-29 17:15:47', 1, 3, 1, 'AT'),
                (3, '2012-05-09 20:25:03', 3, 1, 5, 'DE'),
                (3, '2012-05-20 10:15:23', 3, 4, 4, 'AT'),
                (4, '2012-06-01 10:15:23', 3, 4, 5, 'UK')";
                
        foreach ($insert_tables as $table_name => $query) {
            $result = pg_query($query);
            if ($result) {
                $success_msg[] = 'Inserts into table ' .$table_name. ' was successful. <br>';
            } else {
                $error_msg[] = 'Inserts into table ' .$table_name. ' failed: ' .pg_last_error(). '<br>';
            }
        }
    }
    
    // print all messages
    print_r($success_msg);
    print_r($error_msg);
    
    // close connection to DB
    pg_close($connection);
?>