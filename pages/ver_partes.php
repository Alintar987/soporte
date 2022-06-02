
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
$sql_parte= mysqli_query($conec,"SELECT * FROM partes");
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
			              <th  style="width:20%">N° Parte</th>
			              <th>Descripción</th>

			              <th>Estado</th>
			            </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($sql_parte)) {
									$id_partes=$row['id_partes'];
                $no_parte=$row['no_parte'];
                $descripcion=$row['descripcion'];



                ?>
                <tr>
                    <td><?php echo $no_parte ?> </td>
                    <td><?php echo $descripcion ?></td>
										<td><a href="php/borra_parte.php?parte_id=<?php echo $id_partes ?>">Borrar</a></td>
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
