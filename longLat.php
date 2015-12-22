<?php
header('Content-type: application/json');
$json = file_get_contents("php://input");
$json = json_decode($json, true);
$finalJson = array();
function download_page($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch,CURLOPT_ENCODING , "gzip");
    $retValue = curl_exec($ch);
    curl_close($ch);
    return $retValue;
}

$sXML = download_page('http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json');
$oXML = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',"\357\273\277" . $sXML);
//print_r(json_decode($oXML));
$addJson = json_decode($oXML, true);
$filterJson = $addJson['ServiceDelivery']['StopMonitoringDelivery']['MonitoredStopVisit'];
//print_r($filterJson);
function getLong($line, $data){
    foreach($data as $value => $a){
//        print_r($a);
        $otherArray = $a['MonitoredVehicleJourney']['LineRef'];
        $num = preg_replace("/[^0-9]/","",$otherArray);
        if($line == $num){
            $address = $a['MonitoredVehicleJourney']['MonitoredCall']['StopPointName'];
            $url = "http://maps.google.com/maps/api/geocode/json?address=" . $address . "&sensor=false";
            $url = str_replace(' ', '+', $url);
            $longVal = download_page($url);
            $latVal = json_decode($longVal, true);
//            print_r($latVal);
            $ray = $latVal['results'][0]['geometry']['location'];
            echo $line;
            print_r($ray);
        }else{
            continue;
        }
    }
}
//foreach($json as $a){
    getLong(22, $filterJson);
//}
?>

