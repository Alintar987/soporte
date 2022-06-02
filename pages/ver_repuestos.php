
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
$sql_visita= mysqli_query($conec,"SELECT * FROM repuestos GROUP BY part_order");
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
											<th>Part Order</th>
                      <th>Serial Nuevo:</th>
                      <th>Uso Parte</th>

                      <th>Serial Defectuoso:</th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($sql_visita)) {

                $part_order=$row['part_order'];
                $serial_parte=$row['serial_parte'];
                $uso_parte=$row['uso_parte'];
                $serial_def=$row['serial_def'];
                ?>
                <tr>
                    <td><?php echo $part_order ?> </td>

                    <td><?php echo $serial_parte ?></td>
                    <td><?php echo $uso_parte ?></td>
                    <td><?php echo $serial_def ?></td>
                </tr>
                <?php
                } ?>

              </tbody>
            </table>
          </form>

		</section>
		</container>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#ver_orden').DataTable({
			"pageLength": 5
		});
} );

    </script>
  	</body>
    </html>
