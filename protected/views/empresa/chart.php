<?php
$this->breadcrumbs=array('Empresa','rendimiento','trabajadores');?>
<?php echo BsHtml::pageHeader('Rendimiento','Trabajadores ') ?>
<?php

if (true) {
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
//Cantidad total de evaluaciones ojiva
$total=array();
$suma=0;
foreach ($data as $value) {
	$suma+=$value;
	$total[]=$suma;
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
				'data'=>$total
				)			
			),
		)
	));
$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.4');
$data2=array();
$data3=array();
foreach ($query as $key=>$value) {
	$data2[]=intval($value['DATA']);
	$data3[]=$data[$key]-intval($value['DATA']);

}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad de Evaluaciones Aprobadas sobre el 40% acierto'),
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
$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.5');
$data2=array();
$data3=array();
foreach ($query as $key=>$value) {
	$data2[]=intval($value['DATA']);
	$data3[]=$data[$key]-intval($value['DATA']);

}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad de Evaluaciones Aprobadas sobre el 50% acierto'),
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
$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.6');
$data2=array();
$data3=array();
foreach ($query as $key=>$value) {
	$data2[]=intval($value['DATA']);
	$data3[]=$data[$key]-intval($value['DATA']);

}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad de Evaluaciones Aprobadas sobre el 60% acierto'),
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






$query=RvFicha::AvgByEmpresa($model->primaryKey);
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

$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Grafico Promedio Notas Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>''
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Notas '.RvFicha::getNameClasificacion())
			),
		'series' => array(	
			array(
				'name'=>'Nota promedio ponderada ',
				'data'=>$notas
				),
			// array(
			// 	'name'=>'Fichas Emitidas',
			// 	'data'=>$data
			// 	),
			// array(
			// 	'name'=>'Fichas Reprobadas',
			// 	'data'=>$data3
			// 	)	
			),
		)
	));

//Cantidad de aprobación
$query=RvFicha::CountByEmpresa($model->primaryKey,'rv_ficha.calificacion>0.5');
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

//Cantidad de evaluaciones

$model=RvEvaluacion::FindByEmpresa($model->primaryKey);
if(!empty($model)){
	
//Normalizar evaluacion
$eva=array();
foreach ($model as$n)
	$eva[$n['EVALUACION']][$n['YEAR']][$n['MONTH']]=intval($n['DATA']);

//Limite de fechas
$fecha=array_map(function($n){return mktime(null,null,null,intval($n['MONTH']),1,intval($n['YEAR']));},$model);
$minY=intval(date('Y',min($fecha)));
$minM=intval(date('n',min($fecha)));
$maxY=intval(date('Y',max($fecha)));
$maxM=intval(date('n',max($fecha)));
//Definición de Categoria mes y series
$categories=array();
$list=array();
for ($year=$minY; $year <= $maxY; $year++) {
	for ($month=1; $month <=12; $month++) {
		$categories[]=Validation::strToMonth($month).' '.$year ;
		foreach ($eva as $key => $value) {
			if(isset($value[$year][$month])){
				$list[$key][]=$value[$year][$month];
			}else{
				$list[$key][]=0;
			}
		}
		if($month==$maxM&&$year==$maxY)break;
	}
}
//Tranformar al formato
$series=array();
$i=0;
foreach ($list as $key => $value) {
	$series[$i]['name']=$key;
	$series[$i]['data']=$value;
	$i++;
}

$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas emitidas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad total')
			),
		'series' => $series,
		// array(	
		// 	array(
		// 		'name'=>'Fichas Aprobadas',
		// 		'data'=>$data2
		// 		),
		// 	// array(
		// 	// 	'name'=>'Fichas Emitidas',
		// 	// 	'data'=>$data
		// 	// 	),
		// 	array(
		// 		'name'=>'Fichas Reprobadas',
		// 		'data'=>$data3
		// 		)	
		// 	),
		)
	));



}
}

?>
































