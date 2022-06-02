
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
$sql_visita= mysqli_query($conec,"SELECT * FROM visitas");
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

         		<embed src="pag_vis/index.php" height="750" width="650" style="border:none;">
            <?php include ("url/atras.php"); ?>
				</form>

		</section>
		</container>
  	</body>
    </html>
