<?php


	function bestsellers_get() {
		
		
	}
	
	function bestsellers_display() {
		
		
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
		}
		else {
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
		}
		else {
			return 'getparameterfromXMLstring failed';
		};
	}
