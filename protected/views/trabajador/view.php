<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
?>

<?php
$this->breadcrumbs=array(
	'Trabajadors'=>array('index'),
	$model->tra_id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Trabajador', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Trabajador', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Trabajador', 'url'=>array('update', 'id'=>$model->tra_id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Trabajador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tra_id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Trabajador', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Trabajador '.$model->tra_id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'tra_id',
		'nombre',
		'paterno',
		'materno',
		'nacimiento',
		'fono',
		'mail',
		'creacion',
		'modificado',
	),
)); ?>