<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Configurar los encabezados CORS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit; // Salir para evitar procesar solicitudes OPTIONS
    }
    
    include_once 'Models/Empleado.php';
    include_once 'Models/DbConnect.php';
    include_once 'Models/EmpleadoRol.php';
    include_once 'Controllers/EmpleadoController.php';
    
    $objDb = new DbConnect();
    $conn = $objDb->connect();
    
    $empleado = new Empleado($conn);
    $empleadoRol = new EmpleadoRol($conn);
    $empleadoController = new EmpleadoController($empleado);
    
    $method = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    
    switch ($method) {
        case "GET":
            if ($requestUri === 'obtener-areas') {
                $respuesta = $area->obtenerAreas();
                echo json_encode($respuesta);
                exit();
            }
            break;
        case "POST":
            if ($requestUri === '/prueba-backend-PHP/crear-empleado') {
                header('Content-Type: application/json');
                $respuesta = $empleadoController->crearEmpleado();
                echo json_encode($respuesta);
                exit();
            }
            if ($requestUri === '/prueba-backend-PHP/editar-empleado') {
                header('Content-Type: application/json');
                $respuesta = $empleadoController->editarEmpleado();
                echo json_encode($respuesta);
                exit();
            }
            break;
        case "PUT":
                if ($requestUri === '/prueba-backend-PHP/actualizar-empleado') {
                    header('Content-Type: application/json');
                    $respuesta = $empleadoController->actualizarEmpleado();
                    echo json_encode($respuesta);
                    exit();
                }
                break;
        case "DELETE":
            if ($requestUri === '/prueba-backend-PHP/eliminar-empleado') {
                header('Content-Type: application/json');
                $respuesta = $empleadoController->eliminarEmpleado();
                echo json_encode($respuesta);
                exit();
            }
            break;
        default:
            http_response_code(405); // Método no permitido
            echo json_encode(["error" => "Método no permitido"]);
            exit();
    }    
?>