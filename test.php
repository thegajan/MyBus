<?php
header('Content-type: application/json');
function download_page($path){
//    $headers = array("Content-type: text/xml");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch,CURLOPT_ENCODING , "gzip");
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $retValue = curl_exec($ch);
    curl_close($ch);
    return $retValue;
}

$sXML = download_page('http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json');
//$oXML = stream_get_contents($sXML);
//$oXML = str_replace('" ï»¿', '', $sXML);
//$oXML = str_replace(':[]}}}"', ':[]}}}', $oXML);
//$oXML = substr($sXML, 9);
//$enc = mb_detect_encoding($sXML);
//$oXML = mb_convert_encoding($sXML, "ASCII", $enc);
$oXML = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',"\357\273\277" . $sXML);
//var_dump($oXML);
//print_r(json_decode($oXML));
$longVal = download_page('http://maps.google.com/maps/api/geocode/json?address=7944+McClellan+Rd&sensor=false');
//var_dump($longVal);
$latVal = json_decode($longVal, true);
//print_r($latVal);
$ray = $latVal['results'][0]['geometry']['location'];
print_r($ray);
//print_r(json_decode($sXML));
//$oXML = str_replace("<pre class='xdebug-var-dump' dir='ltr'><small>string</small> <font color='#cc0000'>'ï»¿", '', $sXML);
//$oXML = str_replace("'</font> <i>(length=219)</i></pre>", '', $oXML);
//var_dump($oXML);
//var_dump($sXML);
//echo $sXML;
//return $sXML;
//print_r(json_decode($sXML));
//$o = json_decode($sXML, TRUE);
//var_dump($o);
//////echo ($sXML);
//$c13=chr(13);
//$c10=chr(10);
//$curuser = $sXML;
//$curuser = str_replace(' ', '', $curuser);
//$curuser = str_replace($c13, '', $curuser);
//$curuser = str_replace($c10, '', $curuser);
//$curuser = preg_replace('/\s/', '', $curuser);
//$curuser = preg_replace('~\x{00a0}~','',$curuser);
//echo html_entity_decode($curuser);
////echo htmlentities($curuser);
////$a = simplexml_load_string($sXML);
////var_dump($a);
//$sXML=$curuser;
//$fyom = new DOMDocument;
//$fyom->loadXML($sXML);
//if (!$fyom) {
//    echo 'Error while parsing the document';
//    exit;
//}
////convert DOM document $dom to object $zode
//$qyode = simplexml_import_dom($fyom);

//$oXML = new SimpleXMLElement($sXML);
//$myfile = fopen("newfile.xml", "w") or die("Unable to open file!");
//$txt = $oXML;
//fwrite($myfile, $txt);
//fclose($myfile);
//
////echo ($sXML);
////$curuser = $sXML;
////$curuser = str_replace(' ', '', $curuser);
////$curuser = preg_replace('/\s/', '', $curuser);
////$curuser = preg_replace('~\x{00a0}~','',$curuser);
////$oXML = new SimpleXMLElement($curuser);
////print_r($oXML);
?>