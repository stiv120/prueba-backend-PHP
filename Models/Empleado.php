<?php
    class Empleado {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        //Permite obtener todos los empleados.
        public function obtenerEmpleados() {
            $query = "SELECT * FROM empleados ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Método para insertar un nuevo empleado
        public function insertar($nombre, $email, $sexo, $area_id, $boletin, $descripcion) {
            $sql = "INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion)
                    VALUES (:nombre, :email, :sexo, :area_id, :boletin, :descripcion)";
            $stmt = $this->conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':area_id', $area_id);
            $stmt->bindParam(':boletin', $boletin);
            $stmt->bindParam(':descripcion', $descripcion);

            // Ejecutar la consulta
            return $stmt->execute();
        }

        // Método para actualizar un empleado
        public function actualizar($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $id) {
            $sql = "UPDATE empleados 
                SET nombre = :nombre, 
                    email = :email, 
                    sexo = :sexo, 
                    area_id = :area_id, 
                    boletin = :boletin, 
                    descripcion = :descripcion
                WHERE id = $id";
            $stmt = $this->conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':area_id', $area_id);
            $stmt->bindParam(':boletin', $boletin);
            $stmt->bindParam(':descripcion', $descripcion);

            // Ejecutar la consulta
            return $stmt->execute();
        }

        public function obtenerEmpleadoPorID($id)
        {
            $query = "SELECT * FROM empleados
                WHERE id = $id ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function eliminarEmpleadoPorId($id)
        {
            $query = "DELETE FROM empleados WHERE empleados.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>
