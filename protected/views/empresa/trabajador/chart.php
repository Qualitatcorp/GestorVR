<?php 
$list=RvFicha::FindByTrabajadorAndEmpresa(1,1);
$categories=array_column($list, 'DATE');
$data=array_map(function($value)
{
	return floatval(RvFicha::MapNota(floatval($value),'Sobre 7'));
}, array_column($list, "DATA"));

$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'title' => array('text' => 'Rendimiento Trabajador'),
		// 'tooltip'=>array(
		// 	'valueSuffix'=>' mas alta.'
		// 	),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad total')
			),
		'series' => array(	
			array(
				'name'=>'Nota',
				'data'=>$data
				)			
			),
		)
	));
 ?>