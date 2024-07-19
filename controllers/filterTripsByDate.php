<?php
require_once '../models/trips.php';

$departureDate = $_GET['departureDate'];
$filteredTrips = $tripsModel->getTripsByDate($departureDate);
echo json_encode($filteredTrips);
