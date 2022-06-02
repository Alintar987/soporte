<?php
include_once "../config/conecta.php";

 $part_order=$_POST['part_order'];
 $work_order=$_POST["work_order"];
 $caso=$_POST["caso"];
 $fecha=$_POST["fecha"];
  $no_parte=$_POST["partes"];




if ($work_order=='') {


  $sql_visita= mysqli_query($conec,"SELECT * FROM repuestos GROUP BY part_order");

  while ($row_order=mysqli_fetch_assoc($sql_visita)) {
     $w_part=$row_order['part_order'];
  if ($w_part==$part_order) {
      echo'<script>
          alert("El PO ya esta en uso");
          window.history.go(-1);
        </script>';
        exit;
    }else {
      for ($i=0;$i<count($no_parte);$i++) {

          $insertar = "INSERT INTO repuestos VALUES ('','$part_order','$no_parte[$i]','','','','','','','')";

          $resultado = mysqli_query($conec,$insertar);

          if (!$resultado) {
            echo'<script>
                alert("Error al registrar. Si el problema continua, intente mas tarde");
                window.history.go(-1);
              </script>';
              exit;
          }

        }
            echo '<script>
                alert("Part Order Registrado Correctamente.");
                window.history.go(-1);
              </script>';
              exit;
    }

  }

}//cierre if de insertar part

else {
  for ($i=0;$i<count($no_parte);$i++) {

    $sql_verifica= mysqli_query($conec,"SELECT repuestos.part_order,repuestos.no_parte,visitas.work_order,visitas.part_order FROM repuestos,visitas WHERE visitas.part_order='$part_order' AND repuestos.no_parte='$no_parte[$i]' AND visitas.work_order='$work_order' AND repuestos.part_order='$part_order'");

    $row_verifica=mysqli_fetch_assoc($sql_verifica);

    echo $no_p=$row_verifica['no_parte'];

    if ($no_p!=='') {



      $sql_visita= mysqli_query($conec,"SELECT * FROM visitas");

      while ($row_order=mysqli_fetch_assoc($sql_visita)) {
      	 $w_order=$row_order['work_order'];
         $w_part=$row_order['part_order'];
      	if ($w_order==$work_order) {
      		echo'<script>
      				alert("El WO ya esta en uso");
      				window.history.go(-1);
      			</script>';
      			exit;
      	}elseif ($w_part==$part_order) {
          echo'<script>
      				alert("El PO ya esta en uso");
      				window.history.go(-1);
      			</script>';
      			exit;
        }else {
      		for ($i=0;$i<count($no_parte);$i++) {

      				$insertar = "INSERT INTO repuestos VALUES ('','$part_order','$no_parte[$i]','','','','','','','')";

      				$resultado = mysqli_query($conec,$insertar);

      				if (!$resultado) {
      					echo'<script>
      							alert("Error al registrar. Si el problema continua, intente mas tarde");
      							window.history.go(-1);
      						</script>';
      						exit;
      				}

      			}
            $insertar_v = "INSERT INTO visitas VALUES ('','$caso','$work_order','$part_order','$fecha')";
            $resultado_v = mysqli_query($conec,$insertar_v);

      					echo '<script>
      							alert("Cargue registrado Correctamente.");
      							window.history.go(-1);
      						</script>';
      						exit;
      	}

      }
    }else {

      echo'<script>
  				alert("Contenido duplicado, por favor ingresa los datos nuevamente");
  				window.history.go(-1);
  			</script>';
  			exit;
    }

  }


}

  ?>
