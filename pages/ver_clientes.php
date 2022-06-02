
<?php
session_start();
error_reporting(0);

$varsession = $_SESSION['usuario'];

if ($varsession == NULL || $varsession = '')
{
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		//die();
		header("Location:../index.php");
}
?>

<?php
include ("config/conecta.php");
$sql_clientes= mysqli_query($conec,"SELECT * FROM clientes");
 ?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
<body>
		<section id="container">

				<form name="tecnicos" method="POST" action= "" id="formulario">

          <table id="ver_orden" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>Contacto</th>
                      <th>Ciudad</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($sql_clientes)) {

                $nombre_clientes=$row['nombre_clientes'];
                $contacto=$row['contacto'];
                $ciudad=$row['ciudad'];
                $direccion=$row['direccion'];
                $telefono=$row['telefono'];
                $email=$row['email'];
                ?>
                <tr>
                    <td><?php echo $nombre_clientes ?></td>
                    <td><?php echo $contacto ?></td>
                    <td><?php echo $ciudad ?></td>
                    <td><?php echo $direccion ?></td>
                    <td><?php echo $telefono ?></td>
                    <td><?php echo $email ?></td>
                </tr>
                <?php
                } ?>

              </tbody>
            </table>
            <?php include ("url/atras.php"); ?>
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
