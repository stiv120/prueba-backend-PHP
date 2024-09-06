<?php

class Area {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //Permite obtener todas las áreas.
    public function obtenerAreas() {
        $query = "SELECT * FROM areas ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
