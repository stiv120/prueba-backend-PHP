<?php
    class EmpleadoRol {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        // Método para insertar un nuevo empleado rol
        public function insertar($empleadoId, $rolId) {
            $sql = "INSERT INTO empleado_rol (empleado_id, rol_id)
                    VALUES (:empleado_rol, :rol_id)";
            $stmt = $this->conn->prepare($sql);

            // Vinculamos los parámetros
            $stmt->bindParam(':empleado_rol', $empleadoId);
            $stmt->bindParam(':rol_id', $rolId);

            return $stmt->execute();
        }
    }
?>
