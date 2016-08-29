<?php
$this->breadcrumbs=array(
	'Empresa',
	$model->nombre,
);

array_push($this->menu, 
	array('label'=>'Editar Empresa', 'url'=>array('update', 'id'=>$model->emp_id)),
	array('label'=>'Eliminar Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_id),'confirm'=>'¿Estas seguro que deseas eliminar esta empresa?')),
	array('label'=>'Usuario'),
	array('label'=>'Crear', 'url'=>array('createUsu', 'id'=>$model->emp_id)),
	array('label'=>'Dispositivo'),
	array('label'=>'Asignar', 'url'=>array('createDisp', 'id'=>$model->emp_id)),
	array('label'=>'Licencia'),
	array('label'=>'Asignar', 'url'=>array('createLic', 'id'=>$model->emp_id)),
	array('label'=>'Evaluacion'),
	array('label'=>'Ver Fichas', 'url'=>array('adminFicha', 'id'=>$model->emp_id))
);
?>
<?php echo BsHtml::pageHeader($model->nombre,'Empresa') ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		// 'emp_id',
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

<?php $this->renderPartial('usuario/admin', array('model'=>$model->usuarios)); ?>
<?php $this->renderPartial('dispositivo/admin', array('model'=>$model->dispositivos)); ?>
<?php $this->renderPartial('licencia/admin', array('model'=>$model->licencias)); ?>