<?php 
# Grafico de barras - Cantidad de evaluaciones
$query=RvFicha::CountMonthByUsuario($model->primaryKey);
if(!empty($query)){
$categories=array_column($query, 'CATEGORIES');
$data=array_map('intval', array_column($query, 'DATA'));
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad Total de Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas emitidas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad de fichas')
			),
		'series' => array(	
			array(
				'name'=>'Total Mensual',
				'data'=>$data
				),
			),
		)
	));

// inicio grafica
$data=$model->evaluaciones;
if(!empty($data)){

# Grafico de Cantidad de evaluaciones por usuario
$query=array();
$seriesName=array();
$fechas=array();
# Guarda fechas y nombres de las evaluaciones junto a sus fechas
foreach ($data as $key => $value) {
	$seriesName[]=$value->nombre;
	$query[$key]=RvFicha::CountMonthByUsuario($model->primaryKey,$value->primaryKey);
	$fechas=array_merge($fechas,array_column($query[$key],'CATEGORIES'));
}
# Elimina fecha repetidas y las ordena
$fechas=array_unique($fechas);
sort($fechas);
#Recoleccion de datos por fecha
$data=array();
$categories=array();
foreach ($fechas as $fecha) {
	$categories[]=$fecha;
	foreach ($query as $key => $eva) {
		$flag=1;
		foreach ($eva as $datos) {
			if ($datos['CATEGORIES']==$fecha) {
				$data[$key][]=intval($datos['DATA']);
				$flag=0;
				break;
			}
		}
		if($flag){
			$data[$key][]=0;
		}
	}
}
# Creacion de Serie
$series=array();
foreach ($seriesName as $key => $name) {
	$series[]=array(
		'name'=>$name,
		'data'=>$data[$key]
		);
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart'=>array(
			'type'=>'column'
			),
		'title' => array('text' => 'Cantidad de Evaluaciones'),
		'tooltip'=>array(
			'valueSuffix'=>' fichas emitidas.'
			),
		'xAxis' => array(
			'categories' => $categories
			),	
		'yAxis' => array(
			'title' => array('text' => 'Cantidad de fichas')
			),
		'series' => $series,
		)
	));
}
// fin grafico

# Grafico de lineas - Grafico de acierto
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
}else{
	echo "<h3>No existen evaluaciones</h3>";
}
 ?>
