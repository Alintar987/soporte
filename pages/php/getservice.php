<!DOCTYPE html>
<html lang="es">

<?php include ("../url/head.php"); ?>

<body>



<?php
include ("../config/conecta.php");
//$id_num_parte="PO-102794206";


$sql_parte= mysqli_query($conec,"SELECT * FROM repuestos WHERE part_order='$id_num_parte'");
$sql_re= mysqli_query($conec,"SELECT * FROM repuestos WHERE part_order='$id_num_parte'");
$row_re=mysqli_fetch_assoc($sql_re);
$serial_parte=$row_re['serial_parte'];
$serial_def=$row_re['serial_def'];
$uso_parte=$row_re['uso_parte'];
$po_re=$row_re['part_order'];

$sql_po= mysqli_query($conec,"SELECT * FROM visitas WHERE part_order='$po_re'");
$row_po=mysqli_fetch_assoc($sql_po);
$caso_po=$row_po['caso'];

$sql_or= mysqli_query($conec,"SELECT * FROM ordenes_servicio WHERE id_caso='$caso_po'");
$row_or=mysqli_fetch_assoc($sql_or);
$num_caso_or=$row_or['num_caso'];
$id_caso_or=$row_or['id_caso'];
$nombre_clientes=$row_or['nombre_clientes'];


?><br><br>
<div style="float: right;">
  <h3>ID CASO: <?php echo $id_caso_or ?></h3>
  <h3><?php echo $id_num_parte ?></h3>
  <h2>Número Caso: <?php echo $num_caso_or ?></h2>
  <h2>Cliente: <?php echo $nombre_clientes ?></h2><br>
  <label for="tecnicos">Descripción Parte:</label>
<table border="1" id="tabla_parte" class="display" cellspacing="0" style="width:100%">
  <thead>
            <tr>
              <th rowspan="2" style="width:15%">N° Parte</th>
              <th rowspan="2">Descripción</th>
              <th colspan="2">Opciones</th>
            </tr>
            <tr>
              <th>Estado</th>
              <th>Editar</th>
            </tr>
        </thead>
        <tbody>


<?php
while ($row=mysqli_fetch_assoc($sql_parte)) {
 $no_parte_re=$row['no_parte'];
 $estado_parte_re=$row['estado_parte'];
 $id_repuestos_p=$row['id_repuestos'];


  $sql_re= mysqli_query($conec,"SELECT * FROM partes WHERE id_partes='$no_parte_re'");
  while ($row_p=mysqli_fetch_assoc($sql_re)) {
  $no_parte=$row_p['no_parte'];
  $d_partes=$row_p['id_partes'];
  $descripcion=$row_p['descripcion'];
  $estado_parte=$row_p['estado_parte'];
  ?>
    <tr>
      <td style="padding: 4px;"><?php echo $no_parte ?></td>
      <td style="padding: 4px;"><?php echo $descripcion ?></td>
      <td style="padding: 4px;"><?php echo $estado_parte_re ?></td>
      <td style="padding: 4px;"><a href="edita_parte.php?id_re=<?php echo $id_repuestos_p ?>&parte_id=<?php echo $d_partes ?>&po=<?php echo $id_num_parte ?>">editar</a></td>
    </tr>
  <?php
  }
  }



 ?>
 </tbody>
</table>
<br><br>
</div>
<br>
</body>
</html>
