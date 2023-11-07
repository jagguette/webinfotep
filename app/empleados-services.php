<?php 
    include "../controllers/controller_consultas_api.php";


    class empleadosAPI{

        function getAllEmpleados(){
            $objDB = new ExtraerDatos();
            $data = array();

            if (isset($_GET["id"])){
                $data = $objDB->empleadosDetalle($_GET["id"]);
            }else{
                $data = $objDB->listadoEmpleados();
            }

            $empleados = array();
            $empleados["data"] = array();

            if($data){
                foreach($data as $row){
                    $item = array(
                        "code" => $row["codigo"],
                        "id" => $row["cedula"],                    
                        "name" => $row["nombre"],
                        "addr" => $row["direcc"],
                        "phone" => $row["telefo"],
                        "dateb" => $row["fchnac"],
                        "photo" => $row["foto"],
                        "profile" => $row["perfil"]
                    );
                    array_push($empleados["data"], $item);                
                }
                $empleados["msg"] = "OK";
                $empleados["error"] = "0";
                echo json_encode($empleados);
                
            }else{
                echo json_encode(array("data"=>null, "error"=>"1", "msg"=>"NO hay datos de empleados", ));
            }
        }

        function saveEmpleado($POST){

            //$datos = file_get_contents('php://input'); 
            //var_dump($datos); 
            
            if(isset($POST["nombre"])){//verificar la existencia de envio de datos
                $objDB = new ExtraerDatos();

                $data = array(
                    "ced"=> $POST["cedula"],
                    "nom"=> $POST["nombre"],
                    "dir"=> $POST["direcc"]
                );
                


                $ejecucion = $objDB->saveEmpleados($data);
                if($ejecucion){ // Todo se ejecuto correctamente
                    echo json_encode(array("data"=>null, "error"=>"0", "msg"=>"Empleado registrado", ));                    
                }else{ // Algo paso mal
                    echo json_encode(array("data"=>null, "error"=>"1", "msg"=>"Ocurrio un Error", ));
                }
                //echo json_encode(array("data"=>null, "error"=>"0", "msg"=>"Empleado registrado" ));
            }else{
                echo json_encode(array("data"=>null, "error"=>"2", "msg"=>"Datos incompletos", ));
            }
        }

        function updateEmpleado(){
            echo json_encode(array("data"=>null, "error"=>"0", "msg"=>"Actualizar", ));
        }

        function deleteEmpleado(){
            echo json_encode(array("data"=>null, "error"=>"0", "msg"=>"Eliminar", ));
        }

        function nullRequest(){
            echo json_encode(array("data"=>null, "error"=>"0", "msg"=>"Solicitud Nula", ));
        }




        
    }

?>

