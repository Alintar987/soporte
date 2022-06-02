<?php
include_once "conexion.php";

$tipodoc=$_POST["tipoid"];
$numdoc=$_POST["numdoc"];
$pnombre=$_POST["pnombre"];
$snombre=$_POST["snombre"];
$papellido=$_POST["papellido"];
$sapellido=$_POST["sapellido"];
$genero=$_POST["genero"];
$estadocivil=$_POST["estadocivil"];
$telefono=$_POST["telefono"];
$direccion=$_POST["direccion"];
$correo=$_POST["correo"];
$cargo=$_POST["cargo"];
$tipvehiculo=$_POST["tipvehiculo"];
$placa=$_POST["placa"];
$contra=$_POST["contra"];


$insertar = "INSERT INTO tecnicos VALUES ('NULL','$tipodoc','$numdoc','$pnombre','$snombre','$papellido','$sapellido','$genero','$estadocivil','$telefono','$direccion','$correo','$cargo','$tipvehiculo','$placa','$contra')";



$validacion = mysqli_query($con, "SELECT * FROM tecnicos WHERE num_doc_tec='$numdoc'");

if (mysqli_num_rows($validacion)>0) {
	echo '<script>
			alert("El Usuario ya esta registrado");
			window.history.go(-1);
		</script>';
		exit;
}

$validacion_correo = mysqli_query($con, "SELECT * FROM tecnicos WHERE correo_tecnico='$correo'");

if (mysqli_num_rows($validacion_correo)>0) {
	echo '<script>
			alert("El Correo ya esta registrado");
			window.history.go(-1);
		</script>';
		exit;
}


// ejecutar consulta
$resultado = mysqli_query($con,$insertar);

if (!$resultado) {
	echo'<script>
			alert("Error al registrar. Si el problema continua, intente mas tarde");
			window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Usuario registrado Correctamente. Inicie sesion para continuar.");
			window.location="../inicio_sesion.html";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>