<?php
include_once "../config/conecta.php";

 $part_order=$_POST["part_order"];
 $serial_parte=$_POST["serial_parte"];
 $uso_parte=$_POST['uso_parte'];
 $serial_def=$_POST['serial_def'];

				$insertar = "UPDATE repuestos SET serial_parte='$serial_parte',uso_parte='$uso_parte',serial_def='$serial_def' WHERE part_order='$part_order'";

				$resultado = mysqli_query($conec,$insertar);
				if (!$resultado) {
					echo'<script>
							alert("Error al registrar. Si el problema continua, intente mas tarde");
							window.history.go(-1);
						</script>';
						exit;
				}

					echo '<script>
							alert("Actualizada Correctamente.");
							window.location="../repuestos.php";
						</script>';
						exit;

/*
$no_parte=$_POST["partes"];
$serial_parte=$_POST["serial_parte"];
$uso_parte=$_POST['uso_parte'];
$serial_def=$_POST['serial_def'];

for ($i=0;$i<count($no_parte);$i++) {

		$insertar = "INSERT INTO repuestos VALUES ('','$part_order','$no_parte[$i]','$serial_parte','$uso_parte','$serial_def')";

		$resultado = mysqli_query($con,$insertar);
		if (!$resultado) {
			echo'<script>
					alert("Error al registrar. Si el problema continua, intente mas tarde");
					window.history.go(-1);
				</script>';
				exit;
		}

	}

			echo '<script>
					alert("Visita registrada Correctamente.");
					window.location="../admin.php";
				</script>';
				exit;
*/
//mysqli_close($con);



  ?>
