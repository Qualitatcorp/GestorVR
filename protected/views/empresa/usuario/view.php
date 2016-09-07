<?php
$this->breadcrumbs=array(
	'Empresa','Supervisor',
	$model->RUT,
);

$this->menu=array(
	array('label'=>'Usuario',),
	array('label'=>'Modificar', 'url'=>array('update', 'id'=>$model->primaryKey)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteUsu','id'=>$model->primaryKey),'confirm'=>'¿Estas seguro que deseas eliminar este usuario?'),'visible'=>Yii::app()->user->checkAccess('Cliente')),
	array('label'=>'Fichas',),
	array('label'=>'Buscar', 'url'=>array('update', 'id'=>$model->primaryKey)),
	array('label'=>'Volver', 'url'=>array($model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente'))
	); 

?>
<?php echo BsHtml::pageHeader($model->nombres.' '.$model->paterno.' '.$model->materno,'Supervisor') ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'RUT',
		'nombres',
		'paterno',
		'materno',
		'fono',
		'clasificacion',
	),
));?>
