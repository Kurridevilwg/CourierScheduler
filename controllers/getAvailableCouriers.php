<?
include_once '../models/couriers.php';
include_once '../models/regions.php';

$departureDate = $_GET['departureDate'];
$regionId = $_GET['region'];

$region = $regionsModel -> getRegionById($regionId);
$travelTime = $region['travel_time'];

$availableCouriers = $couriersModel->getAvailableCouriers($departureDate, $travelTime);

$arrivalDate = date('Y-m-d', strtotime($departureDate . ' + ' . $travelTime . ' days'));
$returnDate = date('Y-m-d', strtotime($arrivalDate . ' + ' . $travelTime . ' days'));

echo json_encode(['status' => 'success', 'availableCouriers' => $availableCouriers, 'arrivalDate' => $arrivalDate, 'returnDate' => $returnDate]);
