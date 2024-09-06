<?php
    class EmpleadoController {
        private $empleadoModel;

        public function __construct($empleadoModel) {
            $this->empleadoModel = $empleadoModel;
        }

        public function crearEmpleado() {
            // Configuramos el tipo de respuesta como JSON
            $response = ['status' => 0, 'message' => 'Error desconocido.'];

            // Leemos los datos JSON de la solicitud
            $jsonEmpleado = file_get_contents('php://input');
            $empleado = json_decode($jsonEmpleado);

            // Verificamos si los datos fueron decodificados correctamente
            if ($empleado === null) {
                $response['message'] = 'Datos JSON inválidos.';
                echo json_encode($response);
                return;
            }

            // Verificamos si todos los campos están presentes
            if (isset($empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area_id, $empleado->boletin, $empleado->descripcion)) {
                $empleado = $this->empleadoModel->insertar($empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area_id, $empleado->boletin, $empleado->descripcion);
                if ($empleado) {
                    $response = ['status' => 'success', 'message' => 'Se ha guardado correctamente.'];
                } else {
                    $response['message'] = 'No se ha podido registrar en la base de datos.';
                }
            } else {
                $response['message'] = 'Datos incompletos.';
            }
            return $response;
        }

        public function editarEmpleado()
        {
            // Leemos los datos JSON de la solicitud
            $jsonEmpleado = file_get_contents('php://input');
            $empleado = json_decode($jsonEmpleado);

            // Verificamos si los datos fueron decodificados correctamente
            if ($empleado === null) {
                $response['message'] = 'Datos JSON inválidos.';
                echo json_encode($response);
                return;
            }
            $empleado = $this->empleadoModel->obtenerEmpleadoPorID($empleado->id);
            $response['message'] = 'No se ha podido registrar en la base de datos.';
            if ($empleado) {
                $response = ['status' => 'success', 'datos' => $empleado];
            }
            return $response;
        }

        public function actualizarEmpleado() {
            // Configuramos el tipo de respuesta como JSON
            $response = ['status' => 0, 'message' => 'Error desconocido.'];

            // Leemos los datos JSON de la solicitud
            $jsonEmpleado = file_get_contents('php://input');
            $empleado = json_decode($jsonEmpleado);

            // Verificamos si los datos fueron decodificados correctamente
            if ($empleado === null) {
                $response['message'] = 'Datos JSON inválidos.';
                echo json_encode($response);
                return;
            }

            // Verificamos si todos los campos están presentes
            if (isset($empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area_id, $empleado->boletin, $empleado->descripcion, $empleado->id)) {
                $actualizo = $this->empleadoModel->actualizar($empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area_id, $empleado->boletin, $empleado->descripcion, $empleado->id);
                if ($actualizo) {
                    $response = ['status' => 'success', 'message' => 'Se ha guardado correctamente.'];
                } else {
                    $response['message'] = 'No se ha podido registrar en la base de datos.';
                }
            } else {
                $response['message'] = 'Datos incompletos.';
            }
            return $response;
        }

        public function eliminarEmpleado()
        {
            // Leemos los datos JSON de la solicitud
            $jsonEmpleado = file_get_contents('php://input');
            $empleado = json_decode($jsonEmpleado);

            // Verificamos si los datos fueron decodificados correctamente
            if ($empleado === null) {
                $response['message'] = 'Datos JSON inválidos.';
                echo json_encode($response);
                return;
            }
            $eliminado = $this->empleadoModel->eliminarEmpleadoPorId($empleado->id);
            if (!$eliminado) {
                $response['message'] = 'No se ha podido eliminar en la base de datos.';
            } else {
                $response = ['status' => 'success', 'message' => 'Se ha eliminado el empleado correctamente.'];
            }
            return $response;
        }
    }
?>
