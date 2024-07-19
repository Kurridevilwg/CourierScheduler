<?
require_once '../models/trips.php';
include_once '../models/regions.php';

$regionId = $_POST['region'];
$courierId = $_POST['courier'];
$departureDate = $_POST['departureDate'];

$region = $regionsModel->getRegionById($regionId);
$travelTime = $region['travel_time'];

$arrivalDate = date('Y-m-d', strtotime($departureDate . ' + ' . $travelTime . ' days'));
$returnDate = date('Y-m-d', strtotime($arrivalDate . ' + ' . $travelTime . ' days'));

$trip = $tripsModel->addTrip($regionId, $courierId, $departureDate, $arrivalDate, $returnDate);

if ($trip) {
    $tripDetails = $tripsModel->getTripById($trip);
    echo json_encode(['status' => 'success', 'trip' => $tripDetails]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Не удалось добавить поездку']);
}
