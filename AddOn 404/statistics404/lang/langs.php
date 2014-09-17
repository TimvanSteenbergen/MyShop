<?php
/**
* Translate the given string into the current lanaguage
* If the trasnlation does not exist, returns the default
*  lanaguage translation
* @param string $str string to translate
* @param array $vars optional array of variables to pass to a sprintf translation string
*/
function translate($str, $args = array()) {
	global $strings;

	$return = '';
//echo '<br/>isset($strings[$str])='.isset($strings[$str]);
//echo '<br/>$strings[$str]='.$strings[$str];
	if (!isset($strings[$str]) || empty($strings[$str])) {
		return '?';
	}

	if (empty($args)) {
		return $strings[$str];
	}
	else {
		$sprintf_args = '';

		for ($i = 0; $i < count($args); $i++) {
			$sprintf_args .= "'" . addslashes($args[$i]) . "',";
		}

		$sprintf_args = substr($sprintf_args, 0, strlen($sprintf_args) - 1);
		$string = addslashes($strings[$str]);
  $return = eval("return sprintf('$string',$sprintf_args);");
		return $return;
	}
}

/**
* Translates an email message to the proper language
* @param string $email_index index of the email to translate from the lang.php file
* @param mixed unlimited number of arguments to be placed inline into the email
* @return translated email message
*/
function translate_email($email_index) {
	global $email;

	$return = '';
	$args = func_get_args();

	if (!isset($email[$email_index]) || empty($email[$email_index])) {
            return '?';
	}

	if (func_num_args() <= 1) {
		return $email[$email_index];
	}
	else {
		$sprintf_args = '';

		for ($i = 1; $i < count($args); $i++) {
			$sprintf_args .= "'" . addslashes($args[$i]) . "',";
		}

		$sprintf_args = substr($sprintf_args, 0, strlen($sprintf_args) - 1);
		$return = eval('return sprintf("' . str_replace('"','\"',$email[$email_index]) . "\",$sprintf_args);");
		return $return;
	}
}

/**
* Returns a formatted date for current section
* @param string $date_index index of date to get
* @return formatted date for that index
*/
function translate_date($date_index, $date) {
	global $dates;
	global $days_full;
	global $days_abbr;
	global $months_abbr;
	global $months_full;

	if (!isset($dates[$date_index]) || empty($dates[$date_index])) {
		return '?';
	}

	$date_format = $dates[$date_index];

	// This takes care of when day/month names are not translated by PHP
	if (strpos($date_format, '%a') !== false) {
		$date_format = str_replace('%a', '+d', $date_format);
		$day_name = $days_abbr[date('w', $date)];
	}
	if (strpos($date_format, '%A') !== false) {
		$date_format = str_replace('%A', '+d', $date_format);
		$day_name = $days_full[date('w', $date)];
	}
	if (strpos($date_format, '%b') !== false) {
		$date_format = str_replace('%b', '+m', $date_format);
		$month_name = $months_abbr[date('n', $date)-1];
	}
	if (strpos($date_format, '%B') !== false) {
		$date_format = str_replace('%B', '+m', $date_format);
		$month_name = $months_full[date('n', $date)-1];
	}

	$return = strftime($date_format, $date);

	if (isset($day_name)) {
		$return = str_replace('+d', $day_name, $return);
	}

	if (isset($month_name)) {
		$return = str_replace('+m', $month_name, $return);
	}

	return $return;
}
?>