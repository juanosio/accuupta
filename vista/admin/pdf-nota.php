<?php	
extract($_REQUEST);

include('../conexion/conexionmysqli.php');

// $sql="SELECT inscripcion.nombre, inscripcion.apellido, inscripcion.cedula, inscripcion.id_acreditable, acreditables.acreditable, acreditables.tipo, acreditables.seccion FROM inscripcion INNER JOIN acreditables ON inscripcion.id_acreditable=acreditables.id WHERE inscripcion.id_acreditable=$id";

$sql="SELECT notas.id_inscripcion, notas.nota, inscripcion.nombre, inscripcion.apellido, inscripcion.cedula, inscripcion.id_acreditable, acreditables.nombre_acre, acreditables.tipo, acreditables.seccion FROM notas, inscripcion, acreditables WHERE notas.id_inscripcion=inscripcion.id AND inscripcion.id_acreditable=acreditables.id AND acreditables.id=$id";
// $sql="SELECT * FROM inscripcion";

    date_default_timezone_set('America/Caracas');
    // COMPARO FECHA ACTUAL CON LA ENVIADA
    $fecha_actual = date("d-m-Y");


$resultados=mysqli_query($conexion,$sql);
$i=0;
while ($consulta=mysqli_fetch_array($resultados)) {
	$nombre[$i]         = $consulta['nombre'];
	$apellido[$i]       = $consulta['apellido'];
	$cedula[$i]         = $consulta['cedula'];
	$id_acreditable[$i] = $consulta['id_acreditable'];
	$acreditable[$i]    = $consulta['nombre_acre'];
	$tipo[$i]           = $consulta['tipo'];
	$seccion[$i]        = $consulta['seccion'];
	$nota[$i]           = $consulta['nota'];
	$i++;
}
function articulos ($i,$nombre,$apellido,$cedula,$nota){

	$html='';

	for ($j=0;$j<$i;$j++){
		$cont=$j+1;
		$text='';
		$text='
			<tr>
				<th style="font-size: 12px;">'.$cont.'</th>
				<th style="font-size: 12px;">'.$nombre[$j].'</th>
				<th style="font-size: 12px;">'.$apellido[$j].'</th>
				<th style="font-size: 12px;">V- '.$cedula[$j].'</th>
				<th style="font-size: 12px;">'.$nota[$j].'%</th>
			</tr>
		';
		$html=$html.$text;
		
	}

	return $html;
}

	require_once('TCPDF-master/tcpdf_include.php');
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	$pdf->SetTitle('Reporte de notas');

	$pdf->SetFont('times', '', 9);
	$pdf->AddPage();



	$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="20%" align="center">
			<img src="../../img/UPTA.png" width="80px">
		</td>
		<td width="70%" align="center">
			
			REPÚBLICA BOLIVARIANA DE VENEZUELA <br>
			MINISTERIO DEL PODER POPULAR PARA LA  EDUCACIÓN UNIVERSITARIA<br>
			UNIVERSIDAD POLITÉCNICA TERRITORIAL DEL ESTADO ARAGUA<br>
			“FEDERICO BRITO FIGUEROA”<br>
			LA VICTORIA - ESTADO ARAGUA<br>
			
			</td>
		</tr>
	</table>
	<h2 align="center">Reporte de notas acreditable '.$acreditable[0]. ' '.$tipo[0].' sección '.$seccion[0].'</h2>

	' , 0, 1, 0, true, '', true);

	$datos = articulos($i,$nombre,$apellido,$cedula,$nota);

	$pdf->writeHTMLCell(0, 0, '', '', '<style type="text/css">
 th, td {
    border: 1px solid black;
    text-align: center;
}
</style>
	<br><br><br>
<table>
	<tr>
		<th style="font-size: 12px;" >#</th>
		<th style="font-size: 12px;" >Cédula</th>
		<th style="font-size: 12px;" >Nombre</th>
		<th style="font-size: 12px;" >Apellido</th>
		<th  style="font-size: 12px;" >Nota</th>
	</tr>
	'.$datos.'

  <tr>
  	<td colspan="8" style="font-size: 12px;" >REPORTE DE NOTAS</td>
  </tr>
</table>' , 0, 1, 0, true, '', true);
	$pdf->writeHTMLCell(0, 0, '', '', '<style type="text/css">
 th, td {
    border: 1px solid black;
    text-align: center;
}
</style>
<table>
	<tr>
		<td colspan="2" width="33,33%" style="font-size: 10px;"> 
			FECHA<h2>'.$fecha_actual.'</h2><br>
		 </td>
		<td colspan="2" width="33,33%" style="font-size: 10px;"> 
			COORDINADOR ACREDITABLE<br><br><br><br>FIRMA Y SELLO
		 </td>
		<td colspan="1" width="34%" style="font-size: 10px;"> 
			PROFESOR<br><br><br><br>FIRMA
		 </td>
	</tr>
</table>' , 0, 1, 0, true, '', true);



$pdf->output('reporte_notas.pdf', 'I');
?>