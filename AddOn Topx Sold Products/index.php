<?php

    ini_set("session.gc_maxlifetime", "18000"); // 5 h
	error_reporting(E_ALL^E_NOTICE);
	ini_set('display_errors','1');
	
	session_start();

    require_once ("lib/config.php");
    require_once ("lib/functions.php");
    
    
    $connect = mysql_connect (DB_HOST, DB_USER, DB_PASS);
 	mysql_select_db (DB_NAME) or die (mysql_error());
    
    $action = (isset($_GET["action"])) ? htmlentities($_GET["action"]) : ((isset($_POST["action"])) ? htmlentities($_POST["action"]) : null);

    
    switch ($action) {
        
        case "import" : {
            
            import_order_data($_array_dummy_data);
            topx_process();
            
        } break;
        case "display_data" : {
            
            topx_display();
            
        } break;
        
    }