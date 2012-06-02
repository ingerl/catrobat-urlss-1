<?php
/* 
 * This is the config file for the catrobat URL shortening service.
 * Edit this file with the correct settings and save it on your server.
 */

/*
 * PostgreSQL settings
 */
 
 	// PostgreSQL DB hostname
 	$host = 'localhost';
	
	// PostgreSQL DB portnumber
	$port = 5432;
	
	// The name of the database for the Catrobat URL shortening service
	$database = 'CatrobatURLSS';
	
	// PostgreSQL DB user name
	$user = 'postgres';
	
	// PostgreSQL DB password
	$password = 'postgre123';
 		  	
/*
 * URL shortening settings
 */
 
	/* URL shortening method: 3 or 4 */
	//define('URL_CONVERT', 3);
	/*
	 * 3: generate case sensitive keywords (ie: a3m or a3M)
	 * 4: generate case sensitive keywords (ie: 27hj or 27Hj)
	 */
	 
	/* Duplicates allowed?! */
	//define('URL_DUPLICATE', TRUE)
	/*
	 * TRUE: store every new URL without an check
	 * FALSE: proof, if the new URL already exists in the DB -> if yes: return the existing short URL
	 * /
	 
/*
 * Site options
 */
 
	/* Catrobat installation URL */
	//define('SITE','http://catrob-at.ist.tugraz.at')
	
	/*
	 * Maybe we will also define username(s) and password(s) here 
	 * allowed to access the admin site ie:
	 */
	 $user_password = array(
	 	'admin' => 'password',
		'username' => 'passme'   // you can have more one ore more 'login' => 'password' lines
		);
?>