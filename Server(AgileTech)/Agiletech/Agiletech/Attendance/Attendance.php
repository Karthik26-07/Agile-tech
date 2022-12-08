<?php

include('../Database_Connection/Dbconnect.php');
session_start();
$Latitude = $_GET['Latitude'];
$Longitude = $_GET['Longitude'];

onLocationChanged();

function onLocationChanged() {
    // lat1 and lng1 are the values of a base location location
    $dist = Distance($GLOBALS['Latitude'], $GLOBALS['Longitude'], $lat2 = 12.8859005, $lng2 = 74.8384326);
//   $dist=Distance($GLOBALS['Latitude'], $GLOBALS['Longitude'], $lat2=12.923511, $lng2=74.8640539); 

    if ($dist <= 100) {
        $data = array('response' => 'Put your attendance');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    } else {
        $data = array('response' => 'you are away from the location');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}

function Distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
    $earthRadius = 6371000;

    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    $distance = $angle * $earthRadius;
    return $distance;
}
