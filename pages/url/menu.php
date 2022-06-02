<center style="
    width: 100%;">
<?php
include ("config/conecta.php");

$sql_user= mysqli_query($conec,"SELECT * FROM usuarios WHERE numdoc='$user_se'");
$row_user=mysqli_fetch_array($sql_user);
$tipo_user=$row_user['tipo_user'];
if ($tipo_user==1) {
	$sql_menu= mysqli_query($conec,"SELECT * FROM menu");
	while ($row_menu=mysqli_fetch_array($sql_menu)){

	$id_menu=$row_menu['id_menu'];
	$nom_boton=$row_menu['nom_boton'];
	$url_menu=$row_menu['url_menu'];

	echo $url_menu;
}
?>
<input id="cierre" type="button" onclick=" location.href='php/cerrar_sesion.php' " value="Cerrar Sesion" name="boton" />
<?php
}else {?>
	<input id="rc" type="button" onclick=" location.href='equipos.php' " value="Registro Equipos" name="boton" />
	<input id="rc" type="button" onclick=" location.href='orden_servicio.php' " value="Orden De Servicio" name="boton" />
		<input id="rc" type="button" onclick=" location.href='visitas.php' " value="Cargue Partes" name="boton" />
	<input id="rc" type="button" onclick=" location.href='repuestos.php' " value="Partes Recibidos" name="boton" />

	<input id="rc" type="button" onclick=" location.href='ver_visitas.php' " value="Ver Visitas" name="boton" />
	<br><br>
	<input id="rc" type="button" onclick=" location.href='tecnicos.php' " value="Registro de tecnicos" name="boton"/>
  <input id="rc" type="button" onclick=" location.href='report_orden_servicio.php' " value="Ruta" name="boton"/>
	<input id="cierre" type="button" onclick=" location.href='php/cerrar_sesion.php' " value="Cerrar Sesion" name="boton" />

	<?php

}
 ?>
 </center>
<!--

<center>


</center> -->
