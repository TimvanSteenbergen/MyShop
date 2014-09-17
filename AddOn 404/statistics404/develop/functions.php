<?php

/*
* Define all functions necessary in statistics404
*/

function getelementfromXMLstring ($element, $XMLstring){
/*@param string $var the retrieved value
* @param string $str element to retrieve out of $XMLstring
* @param string $XMLstring contains the XMLdata
*/
$my_startpos=strpos($XMLstring, "<".$element.">")+strlen($element)+2;
if ($my_startpos>=1){
 $my_length=strpos($XMLstring, "</".$element.">")-$my_startpos;
 return substr($XMLstring, $my_startpos, $my_length);
 }else{
 return '';
 };
};

function getparameterfromXMLstring ($parametername, $XMLstring){
/*@param string $var the retrieved value
* @param string $str element to retrieve out of $XMLstring
* @param string $XMLstring contains the XMLdata
*/

if (strpos($XMLstring, $parametername)>0){
 $my_startpos=strpos($XMLstring, $parametername)+strlen($parametername)+3;
 $my_length=strpos($XMLstring, "</",$my_startpos)-$my_startpos;
 return substr($XMLstring, $my_startpos, $my_length);
 }else{
 return 'getparameterfromXMLstring failed';
 };
};
//
//function getXmlValueByTag($inXmlset,$needle){ 
//        $resource    =    xml_parser_create();//Create an XML parser 
//        xml_parse_into_struct($resource, $inXmlset, $outArray);// Parse XML data into an array structure 
//        xml_parser_free($resource);//Free an XML parser 
//        
//        for($i=0;$i<count($outArray);$i++){ 
//            if($outArray[$i]['tag']==strtoupper($needle)){ 
//                $tagValue    =    $outArray[$i]['value']; 
//            } 
//        } 
//        return $tagValue; 
//    } 
//    
?>
