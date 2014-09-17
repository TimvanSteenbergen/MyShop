<?php

/*
 * Do what needs to get done every time
 */
$con = mysql_connect($host, $login, $password);
if (!$con) {
 die('Could not connect: ' . mysql_error());
}
mysql_select_db($database, $con);

/* Define all functions necessary in statistics404 */

function getnumofrecords($shop_id, $my_view, $my_eyes='both_open_and_closed_eyes') {
 /* @param shop_id $var the number of the shop */
 if ($my_eyes == "both_open_and_closed_eyes") {
  $my_eyesclause = "";
 }elseif ($my_eyes == "only_open_eyes") {
  $my_eyesclause = "AND `status` = \"seen\"";
 }  else {
  $my_eyesclause = "AND `status` = \"new\"";
 };
 if ($my_view == 1) {
  $mysql = "SELECT COUNT(*) AS aantal FROM `404` WHERE `shop_id`=\"" . $shop_id . "\" ". $my_eyesclause . " GROUP BY `request_uri`;";
  $result = mysql_query($mysql);
  return mysql_num_rows($result);
 } else {
  $mysql = "SELECT COUNT(*) AS aantal FROM `404` WHERE `shop_id`=\"" . $shop_id . "\" ". $my_eyesclause . ";";
  $result = mysql_query($mysql);
  $row = mysql_fetch_array($result);
  return $row['aantal'];
 };
}

function getelementfromXMLstring($element, $XMLstring) {
 /* @param string $var the retrieved value
  * @param string $str element to retrieve out of $XMLstring
  * @param string $XMLstring contains the XMLdata
  */
//Check the presence of the element in the string.
 if (!strpos($XMLstring, "<" . $element . ">")) {
  return '';
 };

 $my_startpos = strpos($XMLstring, "<" . $element . ">") + strlen($element) + 2;
 if ($my_startpos >= 1) {
  $my_length = strpos($XMLstring, "</" . $element . ">") - $my_startpos;
  return substr($XMLstring, $my_startpos, $my_length);
 } else {
  return '';
 };
}

function getparameterfromXMLstring($parametername, $XMLstring) {
 /* @param string $var the retrieved value
  * @param string $str element to retrieve out of $XMLstring
  * @param string $XMLstring contains the XMLdata
  */
//Check the presence of the element in the string.
 if (!strpos($XMLstring, $parametername)) {
  return '';
 };

 if (strpos($XMLstring, $parametername) > 0) {
  $my_startpos = strpos($XMLstring, $parametername) + strlen($parametername) + 3;
  $my_length = strpos($XMLstring, "</", $my_startpos) - $my_startpos;
  return substr($XMLstring, $my_startpos, $my_length);
 } else {
  return 'getparameterfromXMLstring failed';
 };
}

function getactionvarparameters(&$actionvar, &$pagenr, &$urlsperpage, &$my_sortfield, &$my_sortdirection, &$my_view, &$my_eyes) {

 if (!strpos($actionvar, '&')) {
  return;
 };
 $my_startpos = strpos($actionvar, '&');
 if (!$my_startpos) {
  return;
 };
 $my_paramatersarray = split('&', substr($actionvar, $my_startpos + 1));

 $pagenr = $my_paramatersarray[0];
 $urlsperpage = $my_paramatersarray[1];
 $my_sortfield = $my_paramatersarray[2];
 $my_sortdirection = $my_paramatersarray[3];
 $my_view = $my_paramatersarray[4];
 $my_eyes = $my_paramatersarray[5];
 $actionvar = substr($actionvar, 0, $my_startpos);
}

function setactionvarparameters($pagenr, $urlsperpage, $my_sortfield, $my_sortdirection, $my_view, $my_eyes) {
 $actionvartext = '';
 $actionvartext .= "&" . $pagenr;
 $actionvartext .= "&" . $urlsperpage;
 $actionvartext .= "&" . $my_sortfield;
 $actionvartext .= "&" . $my_sortdirection;
 $actionvartext .= "&" . $my_view;
 $actionvartext .= "&" . $my_eyes;
 return $actionvartext;
}
