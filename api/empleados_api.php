<?php
    include "../app/empleados-services.php";
    $objAPI = new empleadosAPI();

    $method = $_SERVER['REQUEST_METHOD'];
    header("Content-Type: Application/json");
    switch ($method) {
        case 'GET':
            $objAPI->getAllEmpleados();                        
            break;

        case 'POST':
            $_POST = json_decode(file_get_contents("php://input") , true);
            $objAPI->saveEmpleado($_POST);
            break;

        case 'PUT':
            $objAPI->updateEmpleado();
            break;

        case 'DELETE':
            $objAPI->deleteEmpleado();
            break;

        
        default:
            $objAPI->nullRequest();
            break;
    }    
?>