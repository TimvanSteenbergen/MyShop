<?php

	//1 Get the parameters and the action-parameters
	//2 Do the action
	//3 Retrieve the data
	//4 Show the data on screen
	
	require_once('lib/config.php');
	require_once('lib/functions.php');
	require_once('myshopRequest.php');
	
	/* Set your private key for this plugin here */
	$privateKey = '6db7415ddebd2e9842022f71cccda46c485b8f40-1f4553e62e36e693c61a8aeea4e93a575caf9de8';
	
	/* Set base location / path for this plugin */
	$baseLocation = '/connections/statistics404/';
	
	/* Base string for the body */
	$body = '';

	//1 Get the parameters and the action-parameters
	//* Create MyshopRequest instance */
	
	$myshopRequest = new MyshopRequest($privateKey);
	//XMLtextClean is only used to get the editlang. 
	$XMLtext = @file_get_contents('php://input');
	
	$XMLtextClean = str_replace("<![CDATA[", "", str_replace("]]>", "", $XMLtext));


	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<response>';
	echo '<body>	<![CDATA[';
	echo '<style type="text/css">';
	require_once('styles.css');
	echo '</style>';
	echo $body;
	echo ']]>	</body>';
	echo '</response>';