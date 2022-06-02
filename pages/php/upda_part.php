<?php
include_once "conexion.php";
$id_repuestos=$_POST["id_repuestos"];
  echo "<br>".$uso_parte=$_POST["uso_parte"];
  echo "<br>".$no_parte=$_POST["no_parte"];
  echo "<br>".$id_caso=$_POST["id_caso"];
  echo "<br>".$num_ca=$_POST["num_ca"];
    echo "<br>".$part_order=$_POST["part_order"];

    $sql_p=mysqli_query($con,"SELECT id_partes FROM partes WHERE no_parte='$no_parte'");
    $row_p=mysqli_fetch_assoc($sql_p);
    $id_parte=$row_p['id_partes'];



 $insertar = " UPDATE repuestos SET uso_parte='$uso_parte' WHERE id_repuestos='$id_repuestos' AND no_parte='$id_parte' AND part_order='$part_order'";

//mysqli_close($sql_p);





// ejecutar consulta
$resultado = mysqli_query($con,$insertar);

if (!$resultado) {
	echo'<script>
			alert("Error al registrar. Si el problema continua, intente mas tarde");
			window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Uso Parte Actualizado Correctamente.");
			window.location="../ver_part_caso.php?caso_id='.$id_caso.'&caso_n='.$num_ca.'";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);


  ?>
