<?php

	//1 Get the parameters and the action-parameters
	//2 Do the action
	//3 Retrieve the data
	//4 Show the data on screen
	
	include_once('app/Config/database.php');
	include_once('lang/langs.php');
	include_once('functions.php');
	include 'myshopRequest.php';
	
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
	
	/* Get state variables */
	$stateVariables   = $myshopRequest->getStates(); // Returns associative array with all state variables
	$pluginParameters = $myshopRequest->getParams(); // Returns associative array with all plugin parameters
	$my_shop_id       = $myshopRequest->getParam('master_shopid');
	$action           = $myshopRequest->getParam('action');
	$actionvar        = $myshopRequest->getParam('actionvar');
	getactionvarparameters($actionvar, $my_pagenr, $my_urlsperpage, $my_sortfield, $my_sortdirection, $my_view, $my_eyes); // Retrieves the requested parameters from $actionvar
	$my_pagenr        = ($my_pagenr <= 0 or $my_pagenr >= 999) ? 1 : $my_pagenr;
	$my_urlsperpage   = ($my_urlsperpage <= 1 or $my_urlsperpage >= 999) ? 50 : $my_urlsperpage;
	$my_pagenrlast    = max(intval((getnumofrecords($my_shop_id, $my_view, $my_eyes) + $my_urlsperpage - 1) / $my_urlsperpage), 1);
	$my_sortfield     = ( $my_sortfield == '') ? 'index' : $my_sortfield;
	$my_sortdirection = ( $my_sortdirection == '') ? 'ASC' : $my_sortdirection;
	$my_sorttext      = '`' . $my_sortfield . '` ' . $my_sortdirection;
	$my_view          = ( $my_view == '') ? '1' : $my_view;
	$my_eyes          = ( $my_eyes == '') ? 'both_open_and_closed_eyes' : $my_eyes;
	$my_lowerlimit    = $my_pagenr * $my_urlsperpage - $my_urlsperpage;
	
	//Find the editlanguage and include the text-elements for that language
	$my_language = getelementfromXMLstring('editlang', $XMLtextClean);
	if ($my_language == "nl") {
		include_once('lang/nl.lang.php');
	}
	else {//default to english
		include_once('lang/en.lang.php');
	};
	
	/* Get location */
	$location = $myshopRequest->getLocation();
	
	if ($baseLocation . 'start.html' == $location) {
		/* Return start screen */
	}
	else if ($baseLocation . 'settings.html' == $location) {
		/* Return settings screen */
	}
	else if ($baseLocation . 'submit.html' == $location) {
		/* Process user input and return submit screen */
		$name = $pluginParameters['myName']; // Alternatively we could've used $myshopResource->getParameter('myName')
		$body .= '<p>';
		$body .= 'Thank you for your cooperation, your name is:' . $name . '<br/><br/>';
		$body .= 'This is the end of this demo.';
		$body .= '</p>';
	}
	else {
		/* Unknown location / path - do not process */
		error_log('Illegal location detected: ' . $location);
	}
	
	//2 Do the action
	//Actions like Delete, sort, show/hide are all defined in file "actions.php"
	include_once('actions.php');
	
	//3 Retrieve the data
	// Eyes: show all records or only the ones with the eye open/closed
	
	// $body .= '$my_shop_id:' . $my_shop_id . '<br/>';
	// $body .= 'view:' . $my_view . '<br/>';
	// $body .= 'eyes:' . $my_eyes . '<br/>';
	// $body .= 'urlsperpage:' . $my_urlsperpage . '<br/>';
	// $body .= 'getnumofrecords($my_shop_id, $my_view, $my_eyes):' . getnumofrecords($my_shop_id, $my_view, $my_eyes) . '<br/>';
	// $body .= 'pagenrlast:' . $my_pagenrlast . '<br/>';
	$my_pagenrlast = max(intval((getnumofrecords($my_shop_id, $my_view, $my_eyes) + $my_urlsperpage - 1) / $my_urlsperpage), 1);
	if ($my_pagenr >= $my_pagenrlast) {
		$my_pagenr = $my_pagenrlast;
	};
	if ($my_eyes == 'both_open_and_closed_eyes') {
		$my_eyes_whereclause = '';
	}
	elseif ($my_eyes == 'only_open_eyes') {
		$my_eyes_whereclause = ' AND `status`="seen" ';
	}
	else {
		$my_eyes_whereclause = ' AND `status`="new" ';
	};
	
	$my_lowerlimit = $my_urlsperpage * ($my_pagenr - 1);
	if ($my_view == 1) { //View: Grouped
		$mysql = "SELECT `request_uri`, `referer`, `datetime`, `update_data2`, `status`, count(*) as 'aantal' 
					FROM `404` 
					WHERE `shop_id`=" . $my_shop_id . $my_eyes_whereclause . " 
					GROUP BY `404`.`request_uri` 
					ORDER BY $my_sorttext LIMIT " . $my_lowerlimit . "," . $my_urlsperpage . ";";
	}
	else {             //View: Detailed
		$mysql = "SELECT `index`, `request_uri`, `referer`, `datetime`, `update_data2`, `status` 
					FROM `404` 
					WHERE `shop_id`=" . $my_shop_id . $my_eyes_whereclause . " 
					ORDER BY $my_sorttext LIMIT " . $my_lowerlimit . "," . $my_urlsperpage . ";";
	};
	$actionvarparameters = setactionvarparameters($my_pagenr, $my_urlsperpage, $my_sortfield, $my_sortdirection, $my_view, $my_eyes);
	//$body .= 'SQL:' . $mysql;
	$result = mysql_query($mysql);
	
	//4 Show the data on screen
	$body .= '
	<script type="text/javascript" >
		function doAction(action,actionvar){
			var f=getData();
			if(f){
				f["action"].value=action;
				f["actionvar"].value=actionvar;
				postGoto("/connections/statistics404/"+action+".html");  
			};
		};
	</script>';
	$body .= '
	<input type="hidden" name="action" value="1"></input>
	<input type="hidden" name="actionvar" value="0"></input>';
	$body .= '
	<div><h1>' . translate('MWEditor title') . '</h1></div>
	<div><br/>' . translate('MWEditor titletext') . '</div>';
	//<div><br/>' . translate('SendDailyEmail') . '<input name="mail" value="' . translate('YourEmail') . '"></div>
	$body .= '<div><br/></div><div>';
	
	//Setting, sorting, selecting
	//Leftcolumn with SelectAll, SelectNone, DeleteAll, Eyesopen, EyesClosed
	$body .= '<table style="table-layout: fixed; width: 810px;">';
	$body .= '<tr><td style="width: 560px;">';
	$body .= '<img src="https://www.tieka.nl/statistics404/img/checkboxon_low.png" title="' . translate('selectall') . '" onclick="$(\':checkbox\').attr(\'checked\',true);" value="true"></img>' . translate('selectall') . '<br/>';
	$body .= '<img src="https://www.tieka.nl/statistics404/img/checkboxoff_low.png" title="' . translate('selectnone') . '" onclick="$(\':checkbox\').attr(\'checked\',false);" value="false"></img>' . translate('selectnone') . '<br/>';
	$body .= '<img src="https://www.tieka.nl/statistics404/img/delete.png" title="' . translate('delete_allselected') . '" onclick="
	var indexlist=\'\';
	$(\'input[type=checkbox]\').each(function () {if (this.checked){indexlist += (indexlist==\'\' ? this.name : \'-\' + this.name);};});
	doAction(\'delete_allselected\',indexlist+\'' . $actionvarparameters . '\');
	"></img>' . translate('delete_allselected') . '<br/>';
	$body .= '<img src="https://www.tieka.nl/statistics404/img/eyeopen_low.png" title="' . translate('status_newtoseen_allselected') . '" onclick="
	var indexlist=\'\';
	$(\'input[type=checkbox]\').each(function () {if (this.checked){indexlist += (indexlist==\'\' ? this.name : \'-\' + this.name);};});
	doAction(\'status_newtoseen_allselected\',indexlist+\'' . $actionvarparameters . '\');
	"></img>' . translate('status_newtoseen_allselected') . '<br/>';
	$body .= '<img src="https://www.tieka.nl/statistics404/img/eyeclosed_low.png" title="' . translate('status_seentonew_allselected') . '" onclick="
	var indexlist=\'\';
	$(\'input[type=checkbox]\').each(function () {if (this.checked){indexlist += (indexlist==\'\' ? this.name : \'-\' + this.name);};});
	doAction(\'status_seentonew_allselected\',indexlist+\'' . $actionvarparameters . '\');
	"></img>' . translate('status_seentonew_allselected') . '';
	
	//Rightcolumn with SelectView, NumofUrlsperPage, PageArrows
	if ($my_pagenr <= 1 or $my_pagenr >= 999) {
		$my_pagenr = 1;
	};
	
	$body .= '</td><td style="v-align:top;text-align:right;widht:250px;">';
	
	//Choice between GroupedOverview and SingleItems
	
	$body .= translate('show');
	$body .= '<select name="switch_view" onchange="doAction(\'switch_view\',this.value+\'' . $actionvarparameters . '\')" class="width200">';
	$string = ($my_view == '1') ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "1"' . $string . '>' . translate('grouped') . '</option>';
	$string = ($my_view == '2') ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "2"' . $string . '>' . translate('detailed') . '</option>';
	$body .= '</select><br/>';
	
	//Selectbox for Eyes-choice
	
	$body .= translate('show');
	$body .= '<select name="eyes_to_show" onchange="doAction(\'set_view_eyes\',this.value+\'' . $actionvarparameters . '\')" class="width200">';
	$string = ($my_eyes == 'both_open_and_closed_eyes') ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "both_open_and_closed_eyes"' . $string . '>' . translate('both_open_and_closed_eyes') . '</option>';
	$string = ($my_eyes == 'only_open_eyes') ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "only_open_eyes"' . $string . '>' . translate('only_open_eyes') . '</option>';
	$string = ($my_eyes == 'only_closed_eyes') ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "only_closed_eyes"' . $string . '>' . translate('only_closed_eyes') . '</option>';
	$body .= '</select><br/>';
	
	//Selectbox for urls per page
	$body .= translate('show');
	$body .= '<select name="urlsperpage" onchange="doAction(\'set_urlsperpage\',this.value+\'' . $actionvarparameters . '\')" class="width200">';
	$string = ($my_urlsperpage == 5) ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "5"' . $string . '>5 ' . translate('urls on the page') . '</option>';
	$string = ($my_urlsperpage == 10) ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "10"' . $string . '>10 ' . translate('urls on the page') . '</option>';
	$string = ($my_urlsperpage == 50) ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "50"' . $string . '>50 ' . translate('urls on the page') . '</option>';
	$string = ($my_urlsperpage == 100) ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "100"' . $string . '>100 ' . translate('urls on the page') . '</option>';
	$string = ($my_urlsperpage == 200) ? 'style="font-weight: bold" selected="selected"' : '';
	$body .= '<option value = "200"' . $string . '>200 ' . translate('urls on the page') . '</option>';
	$body .= '</select>';
	$body .= '<br/><br/>';
	
	//Selectbox for pagenumber and pageselectors
	$body .= translate('you are on page x of y', array($my_pagenr, $my_pagenrlast)) . "<br/>";
	$body .= '<input class="inputarrow" size="1" title="' . translate('selectfirstpage') . '" onclick="doAction(\'select_firstpage\',\'1' . $actionvarparameters . '\')" value="<<"></input>';
	$body .= '<input class="inputarrow" size="1" title="' . translate('selectpreviouspage') . '" onclick="doAction(\'select_previouspage\',\'' . (($my_pagenr >= 2) ? ($my_pagenr - 1) : 1) . $actionvarparameters . '\')" value="<"></input>';
	$body .= '<select name="pagenr" onchange="doAction(\'select_specificpage\',this.value+\'' . $actionvarparameters . '\')">';
	for ($i = 1; $i <= $my_pagenrlast; $i = $i + 1) {
		if ($i == $my_pagenr) {
			$body .= '<option value = "' . $i . '" style="font-weight: bold" selected="selected">' . $i . '</option>';
		}
		else {
			$body .= '<option value = "' . $i . '">' . $i . '</option>';
		}
	};
	$body .= '</select>';
	$body .= '<input class="inputarrow" size="1" title="' . translate('selectnextpage') . '" onclick="doAction(\'select_nextpage\',\'' . (($my_pagenr <= ($my_pagenrlast - 1)) ? ($my_pagenr + 1) : $my_pagenrlast) . $actionvarparameters . '\')" value=">"></input>';
	$body .= '<input class="inputarrow" size="1" title="' . translate('selectlastpage') . '" onclick="doAction(\'select_lastpage\',\'' . $my_pagenrlast . $actionvarparameters . '\')" value=">>"></input>';
	$body .= '</td></tr></table>';
	
	//The URLS and their data
	$body .= '<br/><table style="border: 1px solid black; table-layout: fixed; width: 810px;"><tr style="background-color:#DDDDDD;">
	<th style="width: 15px;"></th>
	<th style="width: 20px;"></th>
	<th style="width: 25px;"></th>'; //Tableheader: first three empty title-cells
	if ($my_view == 1) {//Titlecell # (only shown in Grouped view)
		$body .= '<th class="tableheader" style="width: 25px;">
		<span onclick="doAction(\'sort_on_field\',\'aantal' . $actionvarparameters . '\');">' . translate('number') . '</span>';
		$body .= (($my_sortfield == 'aantal') ? '<img src="https://www.tieka.nl/statistics404/img/sorted' . (($my_sortdirection == 'ASC') ? 'up' : 'down') . '.png"></img>' : '') . ' <br/></th>';
	};
	if ($my_view == 1) {//Titlecell url/referer (smaller shown in Grouped view compared to Detailed view)
		$body .= '<th class="tableheader" style="width: 250px;">';
	}
	else {
		$body .= '<th class="tableheader" style="width: 275px;">';
	};
	$body .= '<span onclick="doAction(\'sort_on_field\',\'request_uri' . $actionvarparameters . '\');">' . translate('url') . '</span>';
	$body .= (($my_sortfield == 'request_uri') ? '<img src="https://www.tieka.nl/statistics404/img/sorted' . (($my_sortdirection == 'ASC') ? 'up' : 'down') . '.png"></img>' : '') . ' <br/>';
	$body .= '<span onclick="doAction(\'sort_on_field\',\'referer' . $actionvarparameters . '\');">' . translate('referer') . '</span>';
	$body .= (($my_sortfield == 'referer') ? '<img src="https://www.tieka.nl/statistics404/img/sorted' . (($my_sortdirection == 'ASC') ? 'up' : 'down') . '.png"></img>' : '') . ' <br/>';
	$body .= '</th>
	<th style="width: 200px;"><span class="columnsorttext">' . translate('click_to_sort') . '</span><br/><br/></th>
	<th style="width: 150px;"></th>
	<th class="tableheader" style="width: 80px;">
	<span onclick="doAction(\'sort_on_field\',\'datetime' . $actionvarparameters . '\');">' . translate('Date') . '/'
	. (($my_sortfield == 'datetime') ? '<img src="https://www.tieka.nl/statistics404/img/sorted' . (($my_sortdirection == 'ASC') ? 'up' : 'down') . '.png"></img>' : '') . '<br/>' . translate('Time') . '</span></th>
	<th class="tableheader" style="width: 50px;">
	<span onclick="doAction(\'sort_on_field\',\'update_data2' . $actionvarparameters . '\');">404' . '/'
	. (($my_sortfield == 'update_data2') ? '<img src="https://www.tieka.nl/statistics404/img/sorted' . (($my_sortdirection == 'ASC') ? 'up' : 'down') . '.png"></img>' : '') . '<br/>' . translate('Noresult') . '</span></th>
	</tr>'; //Titlecells datetime and 404/Noresult
	$row = mysql_fetch_array($result);
	while ($row) { //Tablelines with urldata
		$body .= '<tr  style="height: 40px;">';
		if ($my_view == 1) {
			$body .= '<td><input type="checkbox" name="' . $row['request_uri'] . '"></td>';
		}
		else {
			$body .= '<td><input type="checkbox" name="' . $row['index'] . '"></td>';
		};
		$body .= '<td><img src="https://www.tieka.nl/statistics404/img/delete.png" title="' . translate('Delete') . '" onclick="doAction(\'delete\',\'' . (($my_view == 1) ? $row['request_uri'] : $row['index']) . $actionvarparameters . '\');"></img></td>';
		if ($row['status'] == 'seen') {
			$body .= '<td><img src="https://www.tieka.nl/statistics404/img/eyeopen.png" title="' . translate('status_seentonew') . '" 
			onclick="doAction(\'status_seentonew\',\'' . (($my_view == 1) ? $row['request_uri'] : $row['index']) . $actionvarparameters . '\');"></img></td>';
		}
		else {
			$body .= '<td><img src="https://www.tieka.nl/statistics404/img/eyeclosed.png" title="' . translate('status_newtoseen') . '" 
			onclick="doAction(\'status_newtoseen\',\'' . (($my_view == 1) ? $row['request_uri'] : $row['index']) . $actionvarparameters . '\');"></img></td>';
		};
		if ($my_view == 1) {
			$body .= '<td> ' . $row['aantal'] . '</td>';
		};
		//  if (strpos($row['request_uri'], "?") > 0) {
		//   $my_pos = strpos($row['request_uri'], "?");
		//  } else {
		//   $my_pos = strlen($row['request_uri']);
		//  };
		$body .= '<td colspan="3"> ' . $row['request_uri'] . '</br>';
		//  $body .= '<td> ' . substr($row['request_uri'], 0, $my_pos) . '</br>';
		//  if ($row['referer'] = '' or !$row['referer']) {
		//   $body .= translate('no referer') . '</td>';
		//  } else {
		$body .= $row['referer'] . '</td>';
		//   $body .= substr($row['referer'], 0, $my_pos) . '</td>';
		//  };
		$body .= '<td style="width:50px;"> ' . $row['datetime'] . '</td>';
		if ($row['update_data2'] == 'page not found') {
			$body .= '<td>404</td></tr>';
		}
		else {
			$body .= '<td>NR</td></tr>';
		};
		
		$body .= '</tr>';
		$row = mysql_fetch_array($result);
	};
	$body .= '</table><br/>';
	$body .= '</div>';
	
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<response>';
	echo '<body>	<![CDATA[';
	echo '<style type="text/css">';
	include_once('styles.css');
	echo '</style>';
	echo $body;
	echo ']]>	</body>';
	echo '</response>';
	
	