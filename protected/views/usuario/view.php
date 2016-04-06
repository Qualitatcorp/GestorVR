<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
?>

<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usu_rut,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Usuario', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Usuario', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Usuario', 'url'=>array('update', 'id'=>$model->usu_rut)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->usu_rut),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Usuario '.$model->usu_rut) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'usu_rut',
		'emp_rut',
		'car_id',
		'usu_nombre',
		'usu_apellido',
		'usu_password',
		'usu_rol',
		'usu_fono',
		'usu_email',
		'usu_fecha_creacion',
		'usu_desabilitado',
	),
)); ?>