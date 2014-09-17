<?php
//The database connection-data
$host = 'localhost';
$login = 'tieka';
$password = 'henk1234';
$database = 'mw_addon_404';

  $XMLtext = @file_get_contents('php://input');
  $XMLtextClean = str_replace("<![CDATA[", "", str_replace("]]>","",$XMLtext));
//Find the edit language and include the text-elements for that language
  include_once('lang/langs.php');
  include_once('functions.php');

// Read all needed variables
  $my_language=getelementfromXMLstring('editlang', $XMLtextClean);
  $my_shop_id=getelementfromXMLstring('vid', $XMLtextClean);


if ($my_language=="nl"){
 include_once('lang/nl.lang.php');
}else{//default to english
 include_once('lang/en.lang.php');
};

//Report back to the editor what 404-url have been registered.
$con = mysql_connect($host, $login, $password);
if (!$con)  {die('Could not connect: ' . mysql_error());  }
mysql_select_db($database, $con);
$mysql="SELECT * FROM `404` WHERE `shop_id`=".$my_shop_id.";";
$result=mysql_query($mysql);

echo '<?xml version="1.0" encoding="UTF-8"?>
<response>
<body>
<![CDATA[<script type="text/javascript" >';
echo 'function doAction(action,actionvar){
 var f=getData();
 if(f){
 	f["action"].value=action;
 	f["actionvar"].value=actionvar;    
  alert("http://www.tieka.nl/statistics404/"+action+".php/?index="+actionvar+"&shop_id=1154200&shop_key=IOUsd45_UHfdJ!TsdfIcxADJu7.JwQ");  
  postGoto(windows.location+"&action="+action+"&actionvar="+actionvar+"&shop_key=IOUsd45_UHfdJ!TsdfIcxADJu7.JwQ");  
 };
};';  
echo '</script>
<input type="hidden" name="action" value="1"></input>
<input type="hidden" name="actionvar"></input>
<div><h1>' . translate('MWEditor title') . '</h1></div>
<div><br/>' . translate('MWEditor titletext') . '</div>
<div><br/>mail:<input name="mail" value="some value"></div>
<div><br/></div><div>';

echo '<br/><table width="650px"><tr><th></th><th>' . translate('Date') . '</th><th>index</th><th>' . translate('Shopid') . '</th></tr>';
$row=mysql_fetch_array($result);
while($row)
{
echo '<tr>';
 echo '<td><input type="checkbox" name="' . $row['index'] . '"></td>'; 
 echo '<td> ' . $row['datetime'] . '</td>'; 
 echo '<td> ' .$row['index'] . '</td>'; 
 echo '<td> ' .$row['shop_id'] . '</td>'; 
 echo '<td><button onclick="doAction(\'delete\',\''. $row['index'] .'\');">' . translate('Delete') . '</button></td></tr>';

if(strpos($row['request_uri'], "?")>0)
    {$my_pos=strpos($row['request_uri'], "?");}
else{$my_pos=strlen($row['request_uri']);};
 echo '<tr><td> ' . translate('url') . '</td>'; 
 echo '<td colspan="3"> ' . substr($row['request_uri'], 0, $my_pos) . '</td></tr>'; 
 echo '<tr><td> ' . translate('referer') . '</td>'; 
 echo '<td colspan="3"> ' . substr($row['referer'], 0, 80) . '</td></tr>'; 
 
echo '</tr>';
 $row=mysql_fetch_array($result);
};
echo '</table>';
echo'</div>
]]>
</body>
</response>';
?>