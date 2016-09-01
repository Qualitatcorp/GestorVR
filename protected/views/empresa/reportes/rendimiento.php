<?php
$this->breadcrumbs=array('Empresa','rendimiento','trabajadores');?>
<?php echo BsHtml::pageHeader('Rendimiento','Trabajadores ') ?>
<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
		'credits'=>array('enabled'=>false),
	  	'title' => array('text' => 'Grafico de evaluaciones'),
		  'xAxis' => array(
			'categories' => array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
			),	
			'yAxis' => array(
				'title' => array('text' => 'Pichula')
			),
			'series' => array(	
				array('name' => 'Fuego y eplociones', 'data' => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4)),
				array('name' => 'pIchula 2', 'data' => array(83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3)),
				array('name' => 'pIchula 3','data'=>array(48.9, 0.8, 39.3, 41.4, 47.0, 0, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2))
		  ),
   )
)); ?>
































