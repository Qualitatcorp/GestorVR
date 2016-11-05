<?php
$this->breadcrumbs=array('Empresa','rendimiento','trabajadores');?>
<?php echo BsHtml::pageHeader('Rendimiento','Trabajadores ') ?>
<?php


//Cantidad de evaluaciones
$query=RvFicha::CountByEmpresa($model->primaryKey);
$categories=array_map(function($value){return Validation::strToMonth($value['MONTH']).' '.$value['YEAR'];}, $query);
$data=array_map('intval', array_column($query, "DATA"));
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'title' => array('text' => 'Cantidad de Evaluaciones emitidas'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas emitidas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad total')
			),
		'series' => array(	
			array(
				'name'=>'Total',
				'data'=>$data
				)			
			),
		)
	));

$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.6');
$data2=array();
foreach ($query as $key=>$value) {
	$data2[]=intval($value['DATA']);
	$data3[]=$data[$key]-intval($value['DATA']);

}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad de Evaluaciones emitidas'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas emitidas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad total')
			),
		'series' => array(	
			array(
				'name'=>'Fichas Aprobadas',
				'data'=>$data2
				),
			// array(
			// 	'name'=>'Fichas Emitidas',
			// 	'data'=>$data
			// 	),
			array(
				'name'=>'Fichas Reprobadas',
				'data'=>$data3
				)	
			),
		)
	));



//Cantidad total de evaluaciones ojiva
$data=array();
$suma=0;
foreach ($query as $value) {
	$suma+=intval($value['DATA']);
	$data[]=$suma;
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'title' => array('text' => 'Grafico Ojiva Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas acumuladas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad Total Acumulado')
			),
		'series' => array(	
			array(
				'name'=>'Total',
				'data'=>$data
				)			
			),
		)
	));



$query=RvFicha::AvgByEmpresa($model->primaryKey);
$categories=array();
$data=array();
foreach ($query as $value) {
	$categories[]=Validation::strToMonth($value['MONTH']).' '.$value['YEAR'] ;
	$data[]=(float)number_format(floatval($value['DATA']*100),2);

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
			'title' => array('text' => 'Porcentaje de acierto (%)')
			),
		'series' => array(	
			array(
				'name'=>'Acierto',
				'data'=>$data
				)			
			),
		)
	));

//Cantidad de aprobación
$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.6');
$categories=array();
$data=array();
foreach ($query as $value) {
	$categories[]=Validation::strToMonth($value['MONTH']).' '.$value['YEAR'] ;
	$data[]=intval($value['DATA']);

}
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
		'title' => array('text' => 'Grafico evaluaciones'),
		  'xAxis' => array(
			'categories' => $categories
			),	
			'yAxis' => array(
				'title' => array('text' => 'Cantidad de fichas')
			),
			'series' => array(	
				array('name' => 'Total', 'data' => $data),
		  ),
   )
));






?>
































