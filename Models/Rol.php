<?php

class Rol {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //Permite obtener todos los roles.
    public function obtenerRoles() {
        $query = "SELECT * FROM roles ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
