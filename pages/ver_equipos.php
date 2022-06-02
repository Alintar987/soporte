
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
$sql_equipos= mysqli_query($conec,"SELECT * FROM equipos");
 ?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
<body>
		<section id="container">

				<form name="tecnicos" method="POST" action= "" id="tecnicos">

          <table id="ver_orden" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Serial</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Product Number</th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($sql_equipos)) {

                $serial_equipo=$row['serial_equipo'];
                $nombre_equipo=$row['nombre_equipo'];
                $descripcion=$row['descripcion'];
                $product_number=$row['product_number'];?>
                <tr>

                    <td><?php echo $serial_equipo ?></td>
                    <td><?php echo $nombre_equipo ?></td>
                    <td><?php echo $descripcion ?></td>
                    <td><?php echo $product_number ?></td>
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
