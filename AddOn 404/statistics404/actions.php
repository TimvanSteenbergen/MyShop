<?php
/* This file defines all actions upon any click in the editor's screen */

if ($action == "delete") {
//Delete a single entries
 if ($my_view == 1) {
  $mysql = "DELETE FROM `mw_addon_404`.`404` WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $mysql = "DELETE FROM `mw_addon_404`.`404` WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "delete_allselected") {
//Delete all selected requested entries
 if ($my_view == 1) {
  $actionvar = str_replace('-', '\' OR `request_uri` = \'', $actionvar);
  $mysql = "DELETE FROM `mw_addon_404`.`404` WHERE `shop_id`='" . $my_shop_id . "' -- WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $actionvar = str_replace('-', '\' OR `index` = \'', $actionvar);
  $mysql = "DELETE FROM `mw_addon_404`.`404` WHERE `shop_id`='" . $my_shop_id . "' -- WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "status_seentonew") {
//Set the status of a single entry to new
 if ($my_view == 1) {
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'new'  WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'new'  WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "status_seentonew_allselected") {
//Set the status of all selected entrys to new
 if ($my_view == 1) {
  $actionvar = str_replace('-', '\' OR `request_uri` = \'', $actionvar);
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'new' WHERE `shop_id`='" . $my_shop_id . "' -- WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $actionvar = str_replace('-', '\' OR `index` = \'', $actionvar);
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'new' WHERE `shop_id`='" . $my_shop_id . "' -- WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "status_newtoseen") {
//Set the status of a single entry to new
 if ($my_view == 1) {
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'seen'  WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'seen'  WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "status_newtoseen_allselected") {
//Set the status of all selected entries to seen
 if ($my_view == 1) {
  $actionvar = str_replace('-', '\' OR `request_uri` = \'', $actionvar);
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'seen' WHERE `shop_id`='" . $my_shop_id . "' --  WHERE `request_uri` = '" . $actionvar . "'";
 } else {
  $actionvar = str_replace('-', '\' OR `index` = \'', $actionvar);
  $mysql = "UPDATE `mw_addon_404`.`404` SET  `status` =  'seen' WHERE `shop_id`='" . $my_shop_id . "' --  WHERE `index` = '" . $actionvar . "'";
 };
 mysql_query($mysql);
};
if ($action == "switch_view") {
//Swith the view to the selected one (1-Grouped or 2-Detailed)
 $my_view = $actionvar;
 if ($my_view == 1) { //View: Grouped
  $my_sortfield = 'aantal';
  $my_sortdirection = 'DESC';
 } else {             //View: Detailed
  $my_sortfield = ( $my_sortfield == 'aantal') ? 'request_uri' : $my_sortfield;
 };
 $my_sorttext = '`' . $my_sortfield . '` ' . $my_sortdirection;
};
if ($action == "set_view_eyes") {
//$body .= 'pagenrlast:'. $my_pagenrlast.'<br/>';
  $my_eyes = $actionvar;
// $my_pagenrlast = max(intval((getnumofrecords($my_shop_id, $my_view, $my_eyes) + $my_urlsperpage - 1)/ $my_urlsperpage), 1);
// if ($my_pagenr >= $my_pagenrlast) {
//  $my_pagenr = $my_pagenrlast;
// };
//$body .= 'pagenrlast:'. $my_pagenrlast.'<br/>';
 };
if ($action == "set_urlsperpage") {
 $my_urlsperpage = $actionvar;
 $my_lowerlimit = $my_pagenr * $my_urlsperpage - $my_urlsperpage; 
 $my_pagenrlast = max(intval((getnumofrecords($my_shop_id, $my_view, $my_eyes) + $my_urlsperpage - 1)/ $my_urlsperpage), 1);
 if ($my_pagenr >= $my_pagenrlast) {
  $my_pagenr = $my_pagenrlast;
 };
};
if ($action == "sort_on_field") {
 if ($actionvar == $my_sortfield) {
  $my_sortdirection = ($my_sortdirection == 'ASC') ? $my_sortdirection = 'DESC' : $my_sortdirection = 'ASC';
 } else {
  $my_sortdirection = 'ASC';
 };
 $my_sorttext = '`' . $actionvar . '` ' . $my_sortdirection;
 $my_sortfield = $actionvar;
};
if ($action == "select_firstpage") {
 $my_pagenr = 1;
};
if ($action == "select_previouspage") {
 $my_pagenr = ($my_pagenr > 1) ? $my_pagenr - 1 : 1;
};
if ($action == "select_specificpage") {
 $my_pagenr = ($actionvar >= 1 && $actionvar <= $my_pagenrlast) ? $my_pagenr = $actionvar : 1;
};
if ($action == "select_nextpage") {
 $my_pagenr = ($my_pagenr < $my_pagenrlast) ? $my_pagenr + 1 : $my_pagenrlast;
};
if ($action == "select_lastpage") {
 $my_pagenr = $my_pagenrlast;
};
