<?php
session_start();
require_once( "../models/models_admin.php");

class ConsultasDB extends DBConfig {
    					
	function consulta_generales($sql){
		$this->config();
		$this->conexion(); 
		  
  		$records = $this->Consultas($sql);		 		  		  		  

  		$this->close();		
		return $records;				
	}

	function dbOperaciones($sql){
		$this->config();
		$this->conexion(); 
		  
  		$records = $this->Operaciones($sql);		 		  		  		  

  		$this->close();		
		return $records;				
	}
}

/**
* IMPLEMENTACION DE ACCESO A CONSULTAS PARA PROTEGER MAS LA VISTA
*/
class ExtraerDatos extends ConsultasDB
{
	// ****************************************************************************
	// Agregue aqui debajo el resto de Funciones - Se ha dejado  Listado y detalle
	// ****************************************************************************
    //MUESTRA LISTADO DE EMPLEADOS
	function listadoEmpleados($start=0, $regsCant = 0){
		$sql = "SELECT * FROM empleados";
		if ($regsCant > 0 )
			 $sql = "SELECT * from empleados $start,$regsCant";
		$lista = $this->consulta_generales($sql);	
		return $lista;
	}
	// DETALLE DE EMPLEADOS SELECICONADA SEGUN ID
	function empleadosDetalle($idu){
		$sql = "SELECT * from empleados where codigo=$idu ";
		$lista = $this->consulta_generales($sql);	
		return $lista;
	}

	function saveEmpleados($data){
		//$hash = password_hash($contra, PASSWORD_DEFAULT);
        $ejecucion = $this->dbOperaciones("INSERT INTO empleados(cedula, nombre, direcc) 
                                            		   values(".$data["ced"].", '".$data["nom"]."', '".$data["dir"]."' ) ");
		return $ejecucion;												   		
	}
	
}//fin CLASE


/*$obj = new ExtraerDatos();

$data = array(
	"ced"=> 234567,
	"nom"=> "Chisten Laster",
	"dir"=> "Calle B45-56"
);
$oper = $obj->saveEmpleados($data);
if($oper){
	echo "ok";
}else{
	echo "error ".$obj->error_message;
}*/

/*$objDBO = new DBConfig();
$objDBO->config();
$objDBO->conexion();

$ejecucion = $objDBO->Operaciones("INSERT INTO empleados(cedula, nombre, direcc) 
									  values(".$data["ced"].", '".$data["nom"]."', '".$data["dir"]."' ) ");

if($ejecucion){ // Todo se ejecuto correctamente
echo "<div class='alert alert-success'>
			Producto ha sido creado correctamente
		</div>";
}else{ // Algo paso mal
echo "<div class='alert alert-danger'>
			Ha ocurrido un error inexperado. "."empleados(cedula, nombre, direcc) 
			values(".$data["ced"].", '".$data["nom"]."', '".$data["dir"]."' ) "."
		</div>";
}

$objDBO->close();
*/


?>
