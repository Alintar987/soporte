<?php 
include_once "php/conexion.php";
	session_start();

$consult=$_SESSION['nit'];


	$datos = $con->query("SELECT * FROM clientes WHERE id_cliente='$consult'");


					
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta name="encoding" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />	
	<title>Registro Tecnicos - Soporte S.A</title>

</head>
<body>
	<header>
			<img src="imagenes/soporte.jpg" id="logo">
	</header>
		<section id="container">

				<form name="tecnicos" method="POST" action= "php/registro_casos.php" id="tecnicos">
				


							<?php
								while ($clientes=mysqli_fetch_array($datos)) { ?>
								
								

			


						<h1> Formulario de registro de Casos </h1><br>
							
						<center><h3>Datos de la Empresa</h3></center><br>

						<label for="tecnicos"> Nit:</label>
							 <?php echo $consult;  ?>
						<label for="tecnicos">Nombre de la Empresa:</label>
							<?php echo $clientes['nombre_cliente'];?>
						<label for="tecnicos"> Direccion de la Empresa:</label>
							<?php echo $clientes['direccion_cliente'];?>
						<label for="tecnicos"> Telefono Empresa:</label>
							<?php echo $clientes['telefono_cliente'];?>

							<center><h3>Datos de la Orden</h3></center><br>
						<label for="tecnicos"> Numero de Orden:</label>
							<input type="text" name="norden" size="50" maxlength="50" required >
						<label for="tecnicos"> Numero de Caso:</label>
								<input type="text" name="ncaso" size="50" maxlength="50" required >
						
							<center><h3>Quien Solicita el Servicio</h3></center><br>		
						<label for="tecnicos"> Nombre del Solicitante:</label>
								<input type="text" name="nomcliente" size="50" maxlength="50" required >
						<label for="tecnicos"> Telefono del Solicitante:</label>
								<input type="text" name="telcliente" size="50" maxlength="50" required >		
						<label for="tecnicos"> Direccion del Servicio:</label>
								<input type="text" name="dircliente" size="50" maxlength="50" required >

							<center><h3>Datos del Equipo</h3></center><br>			
						<label for="tecnicos"> Serial del Equipo:</label>
								<input type="text" name="serial" size="50" maxlength="50" required >
						<label for="tecnicos"> Modelo de Equipo:</label>
								<input type="text" name="modelo" size="50" maxlength="50" required >		
						<label for="tecnicos"> P/N del Equipo:</label>
								<input type="text" name="pn" size="50" maxlength="50" required >
						<label for="tecnicos"> Observaciones del Caso:</label>
								<input type="text" name="observaciones" size="100" maxlength="100" required >		
							
							<center><h3>Tecnico Asignado</h3></center><br>
						<label for="tecnicos"> Codigo del Tecnico Asignado:</label>
								<input type="text" name="tecnico" size="50" maxlength="50" required >

						<input type="submit" value="Enviar" /> 
						<input type="reset" value="Restablecer" />
						<input id="cierre" type="button" onclick=" location.href='index.html'" value="Regresar " name="regresar" /> 
				</form>
	

				<?php } ?>




				</section>

		</container>
				

		<footer>
			
				<h1>Soporte S.A</h1>

		</footer>

	</body>



</html>
