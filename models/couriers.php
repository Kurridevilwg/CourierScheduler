<?php
include_once 'connection.php';

$pdo = Connection::get()->connect();
$couriersModel = new Couriers($pdo);

class Couriers
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCouriers()
    {
        $sql = "SELECT * FROM public.couriers ORDER BY id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableCouriers($departureDate, $travelTime)
    {
        $sql = "SELECT id, name FROM couriers WHERE id NOT IN (
            SELECT courier_id 
            FROM trips 
            WHERE 
                :departure_date BETWEEN departure_date AND return_date
                OR
                departure_date BETWEEN :departure_date AND DATE(:departure_date + INTERVAL '1 DAY' * :travel_time * 2)
        )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':departure_date', $departureDate);
        $stmt->bindValue(':travel_time', $travelTime);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
