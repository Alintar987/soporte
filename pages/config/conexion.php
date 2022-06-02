<?php



	$conexion= mysqli_connect("localhost","root","","cotizador_bs3");

	$tabla_admin="admin";
	$tabla_pl="add_pl";
	$tabla_pl_nom="nombre_pl";
	$tabla_pl_id="id_pl";
	$tabla_em="add_em";
	$tabla_re="productos_demo";
	$tabla_re_id="id_re";
	$tabla_co="add_co";
	$tabla_li="marcas_demo";

	//$tabla_u="admin";


	if (!$conexion){

		echo "Error, no se pudo conectar a la Base de Datos". PHP_EOL;
		echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;

		}
	//echo "Conexion Exitosa!!";



?>
