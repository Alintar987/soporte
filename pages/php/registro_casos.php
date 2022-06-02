<?php
include_once "conexion.php";
 	session_start();
$nit=$_SESSION['nit'];

$orden=$_POST["norden"];
$caso=$_POST["ncaso"];
$cliente=$_POST["nomcliente"];
$telefono=$_POST["telcliente"];
$direccion=$_POST["dircliente"];
$serial=$_POST["serial"];
$modelo=$_POST["modelo"];
$pn=$_POST["pn"];
$tecnico=$_POST["tecnico"];
$estado='ASIGNADO AL TECNICO';
$observacion=$_POST['observaciones'];

echo $pn;
$insertar = "INSERT INTO ordenes VALUES ('$orden','$caso','$nit','$cliente','$telefono','$direccion','$serial','$modelo','$pn','$tecnico','$estado','$observacion')";



$tecn = mysqli_query($con, "SELECT * FROM tecnicos WHERE id_tecnico='$tecnico'");

if (mysqli_num_rows($tecn)<=0) {
	echo '<script>
			alert("El Tecnico Asignado no esta Registrado");
			window.history.go(-1);
		</script>';
		exit;
}else{

$validaorden = mysqli_query($con, "SELECT * FROM ordenes WHERE orden='$orden'");

if (mysqli_num_rows($validaorden)>0) {
	echo '<script>
			alert("El Numero de Orden YA esta en el Sistema");
			window.history.go(-1);
		</script>';
		exit;
}else {

$validacaso = mysqli_query($con, "SELECT * FROM ordenes WHERE caso='$caso'");

if (mysqli_num_rows($validacaso)>0) {
	echo '<script>
			alert("El Numero de Caso YA esta en el Sistema");
			window.history.go(-1);
		</script>';
		exit;
}
}
}

// ejecutar consulta
$resultado = mysqli_query($con,$insertar);

if (!$resultado) {
	echo'<script>
			alert("Error al registrar. Si el problema continua, Comuniquese con el Administrador de Sistema.");
				window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Caso  Registrado  Correctamente. ");
			window.location="../index.html";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>