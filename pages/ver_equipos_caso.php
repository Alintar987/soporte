

<?php
include ("config/conecta.php");
//$serial_equipo='8CG4360HFW';
$sql_equipos= mysqli_query($conec,"SELECT * FROM equipos WHERE serial_equipo='$serial_equipo'");
 ?>



          <table id="ver_orden" class="display" width="100%" border="1"   cellspacing="0" style="width:90%">
              <thead>
                  <tr>

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


                    <td><?php echo $nombre_equipo ?></td>
                    <td><?php echo $descripcion ?></td>
                    <td><?php echo $product_number ?></td>
                </tr>
                <?php
                } ?>

              </tbody>
            </table>
