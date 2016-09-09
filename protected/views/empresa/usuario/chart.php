<?php 


$query=RvFicha::AvgByUsuario($model->primaryKey);
$categories=array();
$data=array();
$notas=array();
foreach ($query as $value) {
	$categories[]=Validation::strToMonth($value['MONTH']).' '.$value['YEAR'] ;
	$data[]=(float)number_format(floatval($value['DATA']*100),2);
	$notas[]=(float)RvFicha::MapNota($value['DATA']);
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'title' => array('text' => 'Grafico Promedio Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>' %'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Porcentaje de acierto')
			),
		'series' => array(	
			array(
				'name'=>'Acierto',
				'data'=>$data
				)			
			),
		)
	));



 ?>