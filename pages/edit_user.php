
<?php
$get_user=$_GET['id_user'];
session_start();
error_reporting(0);

$varsession = $_SESSION['usuario'];
$user_se=$varsession;
if ($varsession == NULL || $varsession = '')
{
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		//die();
		header("Location:../index.php");
}
include ("config/conecta.php");
$sql_user_get= mysqli_query($conec,"SELECT * FROM usuarios WHERE id_user='$get_user'");
$row_user_get=mysqli_fetch_array($sql_user_get);
$id_get=$row_user_get['id_user'];
$user_get=$row_user_get['tipo_user'];
$nombre_get=$row_user_get['nombre_user'];
$pass_get=$row_user_get['password'];
$doc_get=$row_user_get['numdoc'];
$sql_user= mysqli_query($conec,"SELECT * FROM usuarios WHERE numdoc='$user_se'");
$row_user=mysqli_fetch_array($sql_user);
$tipo_user=$row_user['tipo_user'];
if ($tipo_user==1) {?>

	<!DOCTYPE html>
	<html lang="es">

	<?php include ("url/head.php"); ?>
	<body>
		<?php include ("url/header.php"); ?>
			<section id="container">

					<form name="tecnicos" method="POST" action= "php/user_edit.php" id="tecnicos">

							<h1 align="center">Editar Usuarios</h1><br>
									<label for="nombre_user">Nombre Usuario:</label>
									<input type="text" name="nombre_user" value="<?php echo $nombre_get; ?>" required >

									<label for="tecnicos" >Permisos:</label>
                  <select class="" name="permiso">
                    <?php
                    if ($user_get==0) {
                    ?><option value="0">Usuario</option><?php
                    } else {
                      ?><option value="1">Administrador</option><?php
                    }
                    if ($user_get==1) {
                    ?><option value="0">Usuario</option><?php
                    } else {
                      ?><option value="1">Administrador</option><?php
                    }

                     ?>

                  </select>
                  <label for="num_doc">Documento:</label>
									<input type="text" name="numdoc" value="<?php echo $doc_get; ?>" required >
                  <label for="password">Contraseña:</label>
                  <input type="text" name="password" value="<?php echo $pass_get; ?>" required >
                  <input type="hidden" name="id_get_user" value="<?php echo $get_user; ?>">
							<input type="submit" value="Enviar" />
							<?php include ("url/atras.php"); ?>
					</form>







					</form>
			</section>

			</container>


			<footer>

					<h1>Soporte S.A</h1>

			</footer>

		</body>



	</html>

	 <?php

}else {
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		header("Location:admin.php");
}
?>
