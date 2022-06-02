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
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Recibidos de '.$f_inicio.' al '.$f_fin.'')
            ->setCellValue('A2', 'Ciudad')
						->setCellValue('B2', 'Desktops')
						->setCellValue('C2', 'Monitores')
						->setCellValue('D2', 'Portátiles')
						->setCellValue('E2', 'Servidor')
						->setCellValue('F2', 'Total General');
			//->setCellValue('E2', 'CONTINENTE');

//Color encabezado
$objPHPExcel->getActiveSheet()
			    ->getStyle('A1:F1')
			    ->getFill()
			    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			    ->getStartColor()
			    ->setRGB('6DCBE5');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($boldArray);

$boldArray1 = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($boldArray1);


//Alto filas
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(21);

//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(16);

//Ajustar filas
//$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setWrapText(true);

/*Extraer datos de MYSQL*/
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'ordenes');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$sql="SELECT COUNT(*) AS contar,ordenes_servicio.ciudad,equipos.descripcion,ordenes_servicio.fecha_recibido FROM ordenes_servicio,equipos WHERE equipos.id_equipo=ordenes_servicio.id_serial_equipos AND DATE(ordenes_servicio.fecha_recibido) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.ciudad ORDER BY `ordenes_servicio`.`ciudad` ASC";
	$query=mysqli_query($con,$sql);
	$cel=3;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($query)){
		$ciudad=$row['ciudad'];

		$sql_desk="SELECT COUNT(*) AS contar,ordenes_servicio.ciudad,equipos.descripcion,ordenes_servicio.fecha_recibido FROM ordenes_servicio,equipos WHERE equipos.id_equipo=ordenes_servicio.id_serial_equipos AND ordenes_servicio.ciudad='$ciudad' AND equipos.descripcion='Desktop' AND DATE(ordenes_servicio.fecha_recibido) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.ciudad";
		$query_desk=mysqli_query($con,$sql_desk);
		$row_desk=mysqli_fetch_array($query_desk);
		$contar_desk=$row_desk['contar'];

		$sql_monitor="SELECT COUNT(*) AS contar,ordenes_servicio.ciudad,equipos.descripcion,ordenes_servicio.fecha_recibido FROM ordenes_servicio,equipos WHERE equipos.id_equipo=ordenes_servicio.id_serial_equipos AND ordenes_servicio.ciudad='$ciudad' AND equipos.descripcion='Monitor' AND DATE(ordenes_servicio.fecha_recibido) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.ciudad";
		$query_monitor=mysqli_query($con,$sql_monitor);
		$row_monitor=mysqli_fetch_array($query_monitor);
		$contar_monitor=$row_monitor['contar'];

		$sql_portatil="SELECT COUNT(*) AS contar,ordenes_servicio.ciudad,equipos.descripcion,ordenes_servicio.fecha_recibido FROM ordenes_servicio,equipos WHERE equipos.id_equipo=ordenes_servicio.id_serial_equipos AND ordenes_servicio.ciudad='$ciudad' AND equipos.descripcion='Portatil' AND DATE(ordenes_servicio.fecha_recibido) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.ciudad";
		$query_portatil=mysqli_query($con,$sql_portatil);
		$row_portatil=mysqli_fetch_array($query_portatil);
		$contar_portatil=$row_portatil['contar'];

		$sql_servidor="SELECT COUNT(*) AS contar,ordenes_servicio.ciudad,equipos.descripcion,ordenes_servicio.fecha_recibido FROM ordenes_servicio,equipos WHERE equipos.id_equipo=ordenes_servicio.id_serial_equipos AND ordenes_servicio.ciudad='$ciudad' AND equipos.descripcion='Servidor' AND DATE(ordenes_servicio.fecha_recibido) BETWEEN '$f_inicio' AND '$f_fin' GROUP BY ordenes_servicio.ciudad";
		$query_servidor=mysqli_query($con,$sql_servidor);
		$row_servidor=mysqli_fetch_array($query_servidor);
		$contar_servidor=$row_servidor['contar'];

		$suma_ciudad=$contar_desk+$contar_monitor+$contar_portatil+$contar_servidor;


		//$continentName=$row['continentName'];
		$a="A".$cel;
		$b="B".$cel;
		$c="C".$cel;
		$d="D".$cel;
		$e="E".$cel;
		$f="F".$cel;

			//$e="E".$cel;
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($a, $ciudad)
            ->setCellValue($b, $contar_desk)
            ->setCellValue($c, $contar_monitor)
            ->setCellValue($d, $contar_portatil)
						->setCellValue($e, $contar_servidor)
						->setCellValue($f, $suma_ciudad);

			//->setCellValue($e, $continentName);

	$cel+=1;
	}
mysqli_close($con);
$footer=$cel;
$footer1=$cel-1;
/*Fin extracion de datos MYSQL*/
$rango="A1:$f";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 12),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte '.$t_reporte);


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);

//CENTRAR numeros
$boldArray2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('B3:'.$f.'')->applyFromArray($boldArray2);
//inserta filas al final de la tabla
$objPHPExcel->getActiveSheet()->insertNewRowBefore($footer, 1);

$objPHPExcel->setActiveSheetIndex()
            ->setCellValue('A'.$footer, 'Total General');
///auto suma desktop
$objPHPExcel->getActiveSheet()->setCellValue('B'.$footer,'=SUM(B'.$footer1.':B3)');
//autosuma Monitores
$objPHPExcel->getActiveSheet()->setCellValue('C'.$footer,'=SUM(C'.$footer1.':C3)');
//autosuma Monitores
$objPHPExcel->getActiveSheet()->setCellValue('D'.$footer,'=SUM(D'.$footer1.':D3)');
//autosuma Monitores
$objPHPExcel->getActiveSheet()->setCellValue('E'.$footer,'=SUM(E'.$footer1.':E3)');
//autosuma Monitores
$objPHPExcel->getActiveSheet()->setCellValue('F'.$footer,'=SUM(F'.$footer1.':F3)');
////ESTILOS PARA LA FILA INSERTADA AL FINAR DE LA TABLA

$boldArrayf = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A'.$footer.':F'.$footer.'')->applyFromArray($boldArrayf);

//estilo de fondo en la fila final

$objPHPExcel->getActiveSheet()
    ->getStyle('A'.$footer.':F'.$footer.'')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('D9E1F2');


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte '.$t_reporte.'.xls"');
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
