<?php 
$this->title = 'prestamo vigente';
$articulos=$model::get_VIGENTE($id,$inicio,$fin);
if($articulos!=null){
	$col=count($articulos['Prestamo']);
	$tab='<style>
	*{font-family: Verdana !important;}
	.contenido th {background:rgb(220,220,220);}
	.contenido th, .contenido td {border: 1px solid rgb(220,220,220);padding: 2px 10px 2px 10px;vertical-align:middle;}
	h3{text-align:center;}
	td {text-align:left;}
	</style>

   

		<h3>HISTORIAL DE PRESTAMOS</h3>
		<p>'.$articulos['Persona'].'</p>
		<table class="contenido"><tr>
			<th>FECHA</th>
			<th>HORA</th>
			<th>LUGAR</th>
			<th>ARTICULO</th>
			<th>ENCARGADO</th>
			<th>VIGENTE</th>
			</tr><tbody>
		';
				for ($i=0; $i < $col; $i++) {
					$tab.='<tr>';
					$tab.='<td>'.Yii::$app->formatter->asDate(
								 $articulos['Prestamo'][$i]['FECHA'],'php:d-m-Y')
																	   .'</td>';
					$tab.='<td>'.$articulos['Prestamo'][$i]['HORA'].'</td>';
					$tab.='<td>'.$articulos['Prestamo'][$i]['LUGAR'].'</td>';
					$tab.='<td>'.$articulos['Prestamo'][$i]['ARTICULO'].'</td>';
					$tab.='<td>'.$articulos['Prestamo'][$i]['ENCARGADO'].'</td>';
					$vig=$articulos['Prestamo'][$i]['VIGENTE'];
					$tab.='<td align="center" ';
					if($vig=='SI') {
						$tab.=' style="background:rgba(100,255,150,0.5);"';
					}
					$tab.='>'.$vig.'</td>';
					$tab.='</tr>';
				}
	$tab.='</tbody></table>';
	echo $tab;
}