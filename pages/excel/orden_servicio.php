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

$part_order_v=$_POST['part_order'];

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
//$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID CASO')
            ->setCellValue('B1', 'NUMERO CASO')
            ->setCellValue('C1', 'ESTADO')
						->setCellValue('D1', 'CLIENTE')
						->setCellValue('E1', 'CIUDAD')
						->setCellValue('F1', 'WORK ORDER')
						->setCellValue('G1', 'PART ORDER')
						->setCellValue('H1', 'SERIAL EQUIPO')
						->setCellValue('I1', 'CONTACTO')
						->setCellValue('J1', 'DIRECCIÓN')
						->setCellValue('K1', 'TELÉFONO')
						->setCellValue('L1', 'FECHA RECIBIDO');
			//->setCellValue('E2', 'CONTINENTE');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($boldArray);

//Alto filas
//$objPHPExcel->getActiveSheet()->getRowDimension()->setRowHeight(30);

//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);

/*Extraer datos de MYSQL*/
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'ordenes');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
		$cel=2;//Numero de fila donde empezara a crear  el reporte
		foreach($part_order_v as $part_order) {
	$sql="SELECT ordenes_servicio.id_caso,ordenes_servicio.num_caso,ordenes_servicio.estado,ordenes_servicio.nombre_clientes,ordenes_servicio.ciudad,visitas.work_order,visitas.part_order,equipos.serial_equipo,ordenes_servicio.contacto,ordenes_servicio.direccion,ordenes_servicio.telefono,ordenes_servicio.fecha_recibido FROM ordenes_servicio,visitas,equipos,repuestos WHERE visitas.part_order='$part_order' AND repuestos.part_order=visitas.part_order AND ordenes_servicio.id_caso=visitas.caso AND equipos.id_equipo=ordenes_servicio.id_serial_equipos";
	$query=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($query);
		$id_caso=$row['id_caso'];
		$num_caso=$row['num_caso'];
		$estado=$row['estado'];
		$nombre_clientes=$row['nombre_clientes'];
		$ciudad=$row['ciudad'];
		$serial_equipo=$row['serial_equipo'];
		$work_order=$row['work_order'];
		$part_order=$row['part_order'];
		$contacto=$row['contacto'];
		$direccion=$row['direccion'];
		$telefono=$row['telefono'];
		$fecha_recibido=$row['fecha_recibido'];

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

			//$e="E".$cel;
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($a, $id_caso)
            ->setCellValue($b, $num_caso)
            ->setCellValue($c, $estado)
            ->setCellValue($d, $nombre_clientes)
						->setCellValue($e, $ciudad)
						->setCellValue($f, $work_order)
						->setCellValue($g, $part_order)
						->setCellValue($h, $serial_equipo)
						->setCellValue($i, $contacto)
						->setCellValue($j, $direccion)
						->setCellValue($k, $telefono)
						->setCellValue($l, $fecha_recibido);

			//->setCellValue($e, $continentName);

	$cel+=1;

}


/*Fin extracion de datos MYSQL*/
$rango="A1:$l";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte Orden Servicio');


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte.xls"');
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
