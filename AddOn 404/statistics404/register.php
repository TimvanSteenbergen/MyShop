<?php

//This php-script puts one entry in table 404, each time that the Mijnwinkelpage 404 has been requested.
//This to be able to reduce the number of 404's as good as possible
include_once('app/Config/database.php');
$con = mysql_connect($host, $login, $password);
if (!$con) {
 die('Could not connect: ' . mysql_error());
}
//echo 'connected.</br>';
$update_data1 = $_POST["update_data1"];
$values = explode("\t", $update_data1);
$update_data2 = $_POST["update_data2"];

$datetime = date('Y-m-d h:i:s');
$shop_id = $values[0];
$ip = $values[1];
$session_id = $values[2];
$request_uri = $values[3];
$user_agent = $values[4];
$accept_language = $values[5];
$referer = $values[6];
$context_query_string = $values[7]; //Contains key-value pairs related to the context. The string has format "key1=value1&key2=value2&key3=etc..."
//For instance: redirect=0&regp=0&has_next_page=0&url_rpc=%2Frpc&ordernumber=3647800_0&pk=76F59935FCE546B554FBC8A8190ECD93D44E72DB&cid=1&_globalsearch=zondagochtend&url_order_page=%2Fcheckout%2Fplaceorder1&url_myaccount_private=https%3A%2F%2Fwww.mijnwinkel.nl%2Fshop3647800%2Fmyaccount%2F&url_form=%2F&url_basket_page=%2Fcheckout%2Fbasket1&client_query_string=%3F_globalsearch%26%2361%3Bzondagochtend&f=0&page_prev=0&_lang=nl&url_prev_page=%2Fp-1a%2F%3F_globalsearch%26%2361%3Bzondagochtend&session_id=72D66A8A3C52F5B8601BF987AF5DC8D5&url_base_list=%2F&url_next_page=%2Fp-1a%2F%3F_globalsearch%26%2361%3Bzondagochtend&gid=1&resource_location_new=1&registration_level=1&page=0&url_this_ssl=https%3A%2F%2Fwww.mijnwinkel.nl%2Fshop3647800%2Fp-0%2F&view_name=default8&url_change_order_page=%2Fcheckout%2Fplaceorder1&url_base_ssl=%2F&page_next=0&add_session_id=0&uploadType=0&has_lightbox_zoom=1&url_this=%2Fp-0%2F&url_base_page=%2F&url_base=%2F&url_myaccount_public=https%3A%2F%2Fwww.mijnwinkel.nl%2Fshop3647800%2Fmyaccount%2F&_searchblock=1&url_base_page_no_folder=%2F&aid=0&oid=0&vid=3647800&
if ($update_data2 == "no result") {
 $contextarray = explode("&", $context_query_string);
 $contextvariables = array();
 foreach ($contextarray as $contextrecord) {
  $contextsingle = explode("=", $contextrecord);
  $contextvariables[$contextsingle[0]] = str_replace("%20"," ",html_entity_decode(urldecode($contextsingle[1])));
 }
 $client_query_string = $contextvariables["client_query_string"];
 $request_uri=$request_uri.$client_query_string;
}
mysql_select_db($database, $con);
$mysql = "INSERT INTO `mw_addon_404`.`404` 
                    (`index`, `datetime`, `request_uri`, `referer`, `shop_id`, `ip`, `session_id`, `user_agent`, `accept_language`, 
                     `context_query_string`, `client_query_string`, `update_data2`, `update_data1`)
             VALUES (NULL, '" . $datetime . "', '" . $request_uri . "', '" . $referer . "', '" . $shop_id . "', '" . $ip . "', '" . $session_id . "', '" .
    $user_agent . "', '" . $accept_language . "', '" . $context_query_string . "', '" . $client_query_string . "', '" .
    $update_data2 . "', '" . $update_data1 . "');";
//since the contextquerystring takes up most space and is not used, I have stopped registering it by narrowing down the myqsl-query:
$mysql = "INSERT INTO `mw_addon_404`.`404`
                    (`index`, `datetime`, `request_uri`, `referer`, `shop_id`, `ip`, `session_id`, `user_agent`, `accept_language`,
                     `client_query_string`, `update_data2`, `update_data1`))
             VALUES (NULL, '" . $datetime . "', '" . $request_uri . "', '" . $referer . "', '" . $shop_id . "', '" . $ip . "', '" . $session_id . "', '" .
    $user_agent . "', '" . $accept_language . "', '" . $client_query_string . "', '" .
    $update_data2 . "', '" . $update_data1 . "');";
//echo '$mysql:' . $mysql . '</br>';
//For testingpurposes you can change the sql to this, upload register.php to tieka.nl/statistics404 and go to http://www.tieka.nl/statistics404/register.php
//This should put this entry in the database mw_addon_404 in table 404.
//$mysql="INSERT INTO `mw_addon_404`.`404` (
//`index` , `datetime` , `request_uri` , `referer` , `shop_id` , `ip` , `session_id` , `user_agent` , `accept_language` , `context_query_string` , `update_data2` , `status`)
//VALUES ('99999', CURRENT_TIMESTAMP , 'www.xyzxyzxyz.nl/requesturi', 'www.xyzxyzxyz.nl/referer', '3647800', '123.132.123.132', 'session_id', 'user_agent', 'NL', 'context_query_string', 'update_data2', 'new'
//);";

mysql_query($mysql);
mysql_close($con);
echo 'oke';
?>