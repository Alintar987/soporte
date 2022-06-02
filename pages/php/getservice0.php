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
$nombre_clientes=$row_or['nombre_clientes'];


?><br><br>
<div style="float: right;">
  <h3>PO: <?php echo $id_num_parte ?></h3>
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
      <td style="padding: 4px;"><?php echo $estado_parte ?></td>
      <td style="padding: 4px;"><a href="edita_parte.php?parte_id=<?php echo $d_partes ?>">editar</a></td>
    </tr>


  <?php
  }
}
 ?>
 </tbody>
</table>
<label for="tecnicos">Serial Nuevo:</label>
<input type="text" name="serial_parte" value="<?php echo $serial_parte ?>" required>
<label for="tecnicos">Uso parte:</label>
<select name="uso_parte" required>
  <?php if ($uso_parte=='') {?>
    <option value=""></option>
    <option value="Nuevo">Nuevo sin usar</option>
    <option value="Usado">Usado</option>
    <option value="DOA">DOA</option>
    <?php
  } ?>


              <?php if ($uso_parte=='Nuevo') {?>
                <option value="Nuevo">Nuevo sin usar</option>
                <option value="Usado">Usado</option>
                <option value="DOA">DOA</option>
                <?php
              } ?>

                          <?php if ($uso_parte=='Usado') {?>
                            <option value="Usado">Usado</option>
                            <option value="Nuevo">Nuevo sin usar</option>
                            <option value="DOA">DOA</option>
                            <?php
                          } ?>
                                        <?php if ($uso_parte=='DOA') {?>
                                          <option value="DOA">DOA</option>
                                          <option value="Usado">Usado</option>
                                          <option value="Nuevo">Nuevo sin usar</option>

                                          <?php
                                        } ?>

</select>
<label for="s_defec">Serial Defectuoso:</label>
<input type="text" name="serial_def" value="<?php echo $serial_def ?>" required>
<input type="submit"  value="Enviar" />
</div>
<br>
</body>
</html>
