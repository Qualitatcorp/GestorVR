<?php $this->breadcrumbs=array('Evaluación realidad virtual','Ver',);?>
<?php echo BsHtml::pageHeader($model->nombre,$model->tipoNombre) ?>
<?php array_push($this->menu,
		array('label'=>'Pregunta'),
		array('label'=>'Crear', 'url'=>array('createPre','id'=>$model->eva_id))); ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'tipoNombre:Html:Tipo de Evaluación',
		'nombre',
		'descripcion',
		'creado:html:Fecha de Creación',
		'habilitado'
	),
)); ?>
