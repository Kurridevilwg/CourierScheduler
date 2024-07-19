<?php
include_once 'connection.php';

$pdo = Connection::get()->connect();
$tripsModel = new Trips($pdo);

class Trips
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllTrips()
    {
        $sql = "SELECT trips.*, regions.name as region_name, couriers.name as courier_name 
                FROM trips
                JOIN regions ON trips.region_id = regions.id
                JOIN couriers ON trips.courier_id = couriers.id
                ORDER BY departure_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTripById($tripId)
    {
        $sql = "SELECT t.id, r.name as region_name, c.name as courier_name, t.departure_date, t.arrival_date, t.return_date 
                FROM trips t
                JOIN regions r ON t.region_id = r.id
                JOIN couriers c ON t.courier_id = c.id
                WHERE t.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tripId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addTrip($regionId, $courierId, $departureDate, $arrivalDate, $returnDate)
    {
        $sql = "INSERT INTO trips (region_id, courier_id, departure_date, arrival_date, return_date)
                VALUES (:region_id, :courier_id, :departure_date, :arrival_date, :return_date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':region_id', $regionId);
        $stmt->bindValue(':courier_id', $courierId);
        $stmt->bindValue(':departure_date', $departureDate);
        $stmt->bindValue(':arrival_date', $arrivalDate);
        $stmt->bindValue(':return_date', $returnDate);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function getTripsByDate($filterDate)
    {
        $sql = "SELECT t.id, r.name as region_name, c.name as courier_name, t.departure_date, t.arrival_date, t.return_date 
                FROM trips t
                JOIN regions r ON t.region_id = r.id
                JOIN couriers c ON t.courier_id = c.id
                WHERE t.departure_date = :filter_date
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':filter_date', $filterDate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTripByCourierAndDate($courierId, $departureDate)
    {
        $sql = "SELECT * FROM trips WHERE courier_id = ? AND departure_date <= ? AND return_date >= ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courierId, $departureDate, $departureDate]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
