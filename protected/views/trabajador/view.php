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
	array('label'=>'Crear Trabajador', 'url'=>array('create')),
	array('label'=>'Editar Trabajador', 'url'=>array('update', 'id'=>$model->emp_id)),
	array('label'=>'Eliminar Trabajador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_id),'confirm'=>'¿Estas seguro que deseas eliminar este Trabajador?')),
    array('label'=>'Administrar Trabajador', 'url'=>array('admin')),
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