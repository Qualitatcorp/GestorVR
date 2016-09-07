<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
	  	'title' => array('text' => $title),
		  'xAxis' => array(
			'categories' => $categories
			),	
			'yAxis' => array(
				'title' => array('text' => $type)
			),
			'series' => array(	
				array('name' => 'Total', 'data' => $data),
		  ),
   )
));