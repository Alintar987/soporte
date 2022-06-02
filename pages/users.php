
<?php
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
$sql_user_ver= mysqli_query($conec,"SELECT * FROM usuarios");
$sql_user= mysqli_query($conec,"SELECT * FROM usuarios WHERE numdoc='$user_se'");
$row_user=mysqli_fetch_array($sql_user);
$tipo_user=$row_user['tipo_user'];
if ($tipo_user==1) {?>

	<!DOCTYPE html>
	<html lang="es">

	<?php include ("url/head.php"); ?>
	<script src="../css/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
	<body>
			<section id="container">

					<form name="tecnicos" method="GET" action= "" id="tecnicos">

	          <table id="ver_orden" class="display" cellspacing="0" width="100%">
	              <thead>
	                  <tr>

	                      <th>Nombres</th>
	                      <th>Permisos</th>
												<th>Documento</th>
												<th>Contraseña</th>
												<th>Opciones</th>
	                  </tr>
	              </thead>
	              <tbody>
	                <?php while ($row=mysqli_fetch_assoc($sql_user_ver)) {
										$id_user=$row['id_user'];
	                $nombre_user=$row['nombre_user'];
	                $tipo_user=$row['tipo_user'];
									$numdoc=$row['numdoc'];
									$password=$row['password'];



	                ?>
	                <tr>
	                    <td><?php echo $nombre_user ?> </td>
	                    <td><?php
											if ($tipo_user==1) {
												echo "Administrador";
											} else {
												echo "Usuario";
											}

										?></td>
											<td><?php echo $numdoc ?></td>
											<td><?php echo $password ?></td>
											<td>
												<input type="button" onclick=" location.href='edit_user.php?id_user=<?php echo $id_user ?>'" value="Editar" />
											</td>
	                </tr>
	                <?php
	                } ?>

	              </tbody>
	            </table>
	            <?php include ("url/atras.php"); ?>
							<input id="cierre" type="button" onclick=" location.href='reg_user.php'" value="Registrar Nuevo Usuario " name="regresar" />
					</form>

			</section>
			</container>
	    <script type="text/javascript">
	    $(document).ready(function() {
	    $('#ver_orden').DataTable();
	} );

	    </script>
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
