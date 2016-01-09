<?php
//header('Content-type: application/json');
//$json = file_get_contents("php://input");
//$json = json_decode($json, true);
$json = [22];
$finalJson = array();
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
//print_r(json_decode($oXML));
$addJson = json_decode($oXML, true);
$filterJson = $addJson['ServiceDelivery']['StopMonitoringDelivery']['MonitoredStopVisit'];
//$filterJson = $addJson['ServiceDelivery']['StopMonitoringDelivery'];
//print_r($filterJson);
$someArray = array();
function getLong($line, $data)
{
//    $poo = array(0=>'ugh');
    foreach ($data as $value => $a) {
//        echo '<pre>'; print_r($a); echo '</pre>'; echo  'pooooo';
        $otherArray = $a['MonitoredVehicleJourney']['LineRef'];
//        echo '<pre>'; print_r($otherArray); echo '</pre>'; echo  'pooooo';
        $num = preg_replace("/[^0-9]/", "", $otherArray);
//        echo $num;
        if ($line == $num) {
//            echo $line;
//            $poo = array(0=>'hi');
            $address = $a['MonitoredVehicleJourney']['MonitoredCall']['StopPointName'];
//            echo $address;
            $url = "https://maps.google.com/maps/api/geocode/json?address=" . $address . "&sensor=false&key=AIzaSyAiG1PsTYUUvq3ROe2ZNFORXA1_KO7z-QM";
            $url = str_replace(' ', '+', $url);
            $longVal = download_page($url);
            $latVal = json_decode($longVal, true);
//            print_r($latVal);
            $ray = $latVal['results'][0]['geometry']['location'];
//            print_r($ray);
            $b = array('busNum' => $line, 'longLat' => $ray);
//            return $b;
            array_push($someArray, $b);
//            echo $line . "\n";
//            echo $address . "\n";
//            print_r($ray);
        } else {
            continue;
        }
    }
//    print_r($someArray);
//    return $someArray;
}

foreach($json as $a){
//error_reporting(E_ALL);
//getLong(22, $filterJson);
    getLong($a, $filterJson);
//    $finalJson = array_push($finalJson, $finalJsons);
//    $finalJsonss = json_encode($);
}
$jjson = json_encode($someArray);
print_r($jjson);
?>

