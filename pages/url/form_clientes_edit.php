<label for="tecnicos">Nombre de la Empresa:</label>
<input type="text" name="nombre_cliente" value="<?php echo $nombre_cliente ?>" readonly >
<label for="tecnicos">Contacto:</label>
<input type="text" name="contacto" value="<?php echo $contacto ?>"  >
<label for="tecnicos"> Ciudad:</label>

<?php  include ("url/ciudad.php"); ?>

<label for="tecnicos"> Direccion:</label>
<input type="text" name="direccion" value="<?php echo $direccion ?>" required >
<label for="tecnicos"> Telefono:</label>
<input type="text" name="telefono" value="<?php echo $telefono ?>" required >
<label for="tecnicos"> Movil:</label>
<input type="text" name="movil" value="<?php echo $movil ?>" required >
<label for="tecnicos"> Correo electrónico:</label>
<input type="email" name="email" value="<?php echo $email ?>"  required >
