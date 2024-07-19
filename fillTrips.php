<?php
require_once './models/trips.php';
require_once './models/regions.php';
require_once './models/couriers.php';

$allRegions = $regionsModel->getAllRegions();
$allCouriers = $couriersModel->getAllCouriers();

$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-3 months'));

foreach ($allCouriers as $courier) {
    $departureDate = $startDate;
    while (strtotime($departureDate) <= strtotime($endDate)) {
        // Случайный выбор региона
        $region = $allRegions[array_rand($allRegions)];

        $travelTime = $region['travel_time'];
        $arrivalDate = date('Y-m-d', strtotime($departureDate . ' + ' . $travelTime . ' days'));
        $returnDate = date('Y-m-d', strtotime($arrivalDate . ' + ' . $travelTime . ' days'));

        // Проверка на наличие пересечения поездок у курьера
        $existingTrip = $tripsModel->getTripByCourierAndDate($courier['id'], $departureDate);
        if (!$existingTrip) {
            $tripsModel->addTrip($region['id'], $courier['id'], $departureDate, $arrivalDate, $returnDate);
        }

        $departureDate = date('Y-m-d', strtotime($departureDate . ' + 1 days'));
    }
}

echo "Данные по поездкам за три месяца успешно заполнены.";
