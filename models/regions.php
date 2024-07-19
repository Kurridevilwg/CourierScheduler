<?php
include_once 'connection.php';

$pdo = Connection::get()->connect();
$regionsModel = new Regions($pdo);

class Regions
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllRegions() {
        $sql = "SELECT * FROM public.regions ORDER BY id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRegionById($regionId)
    {
        $sql = "SELECT travel_time FROM public.regions WHERE id = :region_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':region_id', $regionId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
