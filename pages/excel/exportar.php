<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

$t_reporte=$_POST['t_reporte'];
$f_inicio=$_POST['f_inicio'];
$f_fin=$_POST['f_fin'];
if ($t_reporte=='cobro') {


if (PHP_SAPI == 'cli')
	die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Soporte S.A")
							 ->setLastModifiedBy("Soporte S.A")
							 ->setTitle("Office 2010 XLSX Documento de prueba")
							 ->setSubject("Office 2010 XLSX Documento de prueba")
							 ->setDescription("Documento de prueba para Office 2010 XLSX, generado usando clases de PHP.")
							 ->setKeywords("office 2010 openxml php")
							 ->setCategory("Reportes");



// Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:W1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'COBROS')
            ->setCellValue('A2', 'ID CASO')
            ->setCellValue('B2', 'NUMERO CASO')
            ->setCellValue('C2', 'ESTADO')
						->setCellValue('D2', 'FECHA CREACIÓN')
						->setCellValue('E2', 'FECHA RECIBIDO')
						->setCellValue('F2', 'FECHA ONSITE')
						->setCellValue('G2', 'FECHA REPAIR')
						->setCellValue('H2', 'FECHA CIERRE')
						->setCellValue('I2', 'NOMBRE CLIENTE')
						->setCellValue('J2', 'CONTACTO')
						->setCellValue('K2', 'CIUDAD')
						->setCellValue('L2', 'DIRECCIÓN')
						->setCellValue('M2', 'TELEFONO')
						->setCellValue('N2', 'MOVIL')
						->setCellValue('O2', 'EMAIL')
						->setCellValue('P2', 'SERIAL EQUIPO')
						->setCellValue('Q2', 'NOMBRE EQUIPO')
						->setCellValue('R2', 'DESCRIPCIÓN')
						->setCellValue('S2', 'PRODUCT NUMBER')
						->setCellValue('T2', 'DESCRIPCIÓN SERVICIO')
						->setCellValue('U2', 'SOLUCIÓN')
						->setCellValue('V2', 'TIPO SERVICIO')
						->setCellValue('W2', 'FECHA CONTRATO');
			//->setCellValue('E2', 'CONTINENTE');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:W2')->applyFromArray($boldArray);

//Alto filas
$objPHPExcel->getActiveSheet()->getRowDimension()->setRowHeight(30);

//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(19);

/*Extraer datos de MYSQL*/
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'ordenes');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$sql="SELECT * FROM ordenes_servicio,equipos WHERE ordenes_servicio.estado='Caso cerrado' AND equipos.id_equipo=ordenes_servicio.id_serial_equipos AND DATE(fecha_cierre) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.num_caso";
	$query=mysqli_query($con,$sql);
	$cel=3;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($query)){
		$id_caso=$row['id_caso'];
		$num_caso=$row['num_caso'];
		$estado=$row['estado'];
		$fecha_creacion=$row['fecha_creacion'];
		$fecha_recibido=$row['fecha_recibido'];
		$fecha_onsite=$row['fecha_onsite'];
		$fecha_repair=$row['fecha_repair'];
		$fecha_cierre=$row['fecha_cierre'];
		$nombre_clientes=$row['nombre_clientes'];
		$contacto=$row['contacto'];
		$ciudad=$row['ciudad'];
		$direccion=$row['direccion'];
		$telefono=$row['telefono'];
		$movil=$row['movil'];
		$email=$row['email'];
		$serial_equipo=$row['serial_equipo'];
		$nombre_equipo=$row['nombre_equipo'];
		$descripcion=$row['descripcion'];
		$product_number=$row['product_number'];
		$descripcion_servicio=$row['descripcion_servicio'];
		$sol_servicio=$row['sol_servicio'];
		$tipo_servicio=$row['tipo_servicio'];
		$fecha_contrato=$row['fecha_contrato'];

		//$continentName=$row['continentName'];
		$a="A".$cel;
		$b="B".$cel;
		$c="C".$cel;
		$d="D".$cel;
		$e="E".$cel;
		$f="F".$cel;
		$g="G".$cel;
		$h="H".$cel;
		$i="I".$cel;
		$j="J".$cel;
		$k="K".$cel;
		$l="L".$cel;
		$m="M".$cel;
		$n="N".$cel;
		$o="O".$cel;
		$p="P".$cel;
		$q="Q".$cel;
		$r="R".$cel;
		$s="S".$cel;
		$t="T".$cel;
		$u="U".$cel;
		$v="V".$cel;
		$w="W".$cel;

			//$e="E".$cel;
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($a, $id_caso)
            ->setCellValue($b, $num_caso)
            ->setCellValue($c, $estado)
            ->setCellValue($d, $fecha_creacion)
						->setCellValue($e, $fecha_recibido)
						->setCellValue($f, $fecha_onsite)
						->setCellValue($g, $fecha_repair)
						->setCellValue($h, $fecha_cierre)
						->setCellValue($i, $nombre_clientes)
						->setCellValue($j, $contacto)
						->setCellValue($k, $ciudad)
						->setCellValue($l, $direccion)
						->setCellValue($m, $telefono)
						->setCellValue($n, $movil)
						->setCellValue($p, $email)
						->setCellValue($p, $serial_equipo)
						->setCellValue($q, $nombre_equipo)
						->setCellValue($r, $descripcion)
						->setCellValue($s, $product_number)
						->setCellValue($t, $descripcion_servicio)
						->setCellValue($u, $sol_servicio)
						->setCellValue($v, $tipo_servicio)
						->setCellValue($w, $fecha_contrato);

			//->setCellValue($e, $continentName);

	$cel+=1;
	}


/*Fin extracion de datos MYSQL*/
$rango="A2:$w";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte cobro');


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte'.$t_reporte.'.xls"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');

// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}elseif ($t_reporte=='bono') {
	include ("exportar_bono.php");
}elseif ($t_reporte=='recibidos') {
	include ("exportar_re.php");
	# code...
}elseif ($t_reporte=='solucionados') {
	include ("exportar_so.php");
	# code...
}
