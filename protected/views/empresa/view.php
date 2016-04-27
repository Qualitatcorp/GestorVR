<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
?>

<?php
$this->breadcrumbs=array(
	'Empresa',
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Crear Empresa', 'url'=>array('create')),
	array('label'=>'Editar Empresa', 'url'=>array('update', 'id'=>$model->emp_id)),
	array('label'=>'Eliminar Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_id),'confirm'=>'¿Estas seguro que deseas eliminar esta empresa?')),
    array('label'=>'Administrar Empresa', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Ver','Empresa '.$model->nombre) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'emp_id',
		'razon_social',
		'nombre',
		'rut',
		array(
			'name'=>'com_id',
			'value'=>Comuna::model()->findByPk($model->com_id)->com_nombre
			),
		'giro',
		'fono',
		'mail',
		'creado',
		'activa',
	),
)); ?>