<?php
            //Variables for connecting to your database.
            //These variable values come from your hosting account.
            $hostname = "GuestbookPhp1.db.8376326.hostedresource.com";
            $username = "GuestbookPhp1";
            $dbname = "GuestbookPhp1";

            //These variable values need to be changed by you before deploying
            $password = "password";
            $usertable = "messages";
            $yourfield = "name";
        
            //Connecting to your database
            mysql_connect($hostname, $username, $password) OR DIE ("Unable to 
            connect to database! Please try again later.");
	        	mysql_query("SET NAMES 'utf8'");
            mysql_select_db($dbname);

?>
