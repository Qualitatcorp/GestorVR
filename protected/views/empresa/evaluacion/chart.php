
<div class="row">
	<div class="col-md-6">
		<?php 
		$categories=array_map(function ($n){return $n['MONTH'].'-'.$n['YEAR'];}, $model);
		$data=array_map('intval',array_column($model, 'DATA'));
		$this->Widget('ext.highcharts.HighchartsWidget', array(
			'options' => array(
				'chart'=>array(
					'type'=>'column'
					),
				'title' => array('text' => 'Cantidad de evaluaciones'),
				'tooltip'=>array(
					'valueSuffix'=>' fichas emitidas.'
					),
				'xAxis' => array(
					'categories' => $categories
					),	
				'yAxis' => array(
			'allowDecimals'=>false,
					'title' => array('text' => 'Cantidad')
					),
				'series' => array(	
					array(
						'name'=>'Fichas emitidas',
						'data'=>$data
						),
					)
				)
			));
		 ?>
	</div>	
	<div class="col-md-6">
	</div>	
</div>