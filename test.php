<?php
function download_page($path)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $path);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    $retValue = curl_exec($ch);
    curl_close($ch);
    return $retValue;
}

$sXML = download_page('http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json');
//$sXML = file_get_contents('sample.json');
$oXML = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', "\357\273\277" . $sXML);
print $oXML;
////print_r(json_decode($oXML));
//$addJson = json_decode($oXML, true);
//$filterJson = $addJson['ServiceDelivery']['StopMonitoringDelivery']['MonitoredStopVisit'];
//echo sizeof($filterJson, 1);
//echo '<br>';
//$filterJson = array_unique($filterJson, SORT_REGULAR);
////    unset($arr)
//array_values($addJson);
//echo sizeof($filterJson, 1);
?>