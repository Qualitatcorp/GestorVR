<?php $this->breadcrumbs=array(
	'Trabajador',
	$model->rut,
);?>
<?php echo BsHtml::pageHeader('Trabajador',$model->rut) ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'rut',
		'nombre',
		'paterno',
		'materno',
	),
));?>
<?php $this->renderPartial('trabajador/chart',array('model'=>$model)); ?>