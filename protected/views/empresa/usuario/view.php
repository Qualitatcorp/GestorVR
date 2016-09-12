<?php
$this->breadcrumbs=array('Empresa','Supervisor',$model->RUT);
if(Yii::app()->user->checkAccess('Cliente')){
	$this->menu[]=array('label'=>'Usuario');
	$this->menu[]=array('label'=>'Modificar', 'url'=>array('update', 'id'=>$model->primaryKey));
	$this->menu[]=array(
		'label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array(
			'submit'=>array('deleteUsu','id'=>$model->primaryKey),
			'confirm'=>'¿Estas seguro que deseas eliminar este usuario?'),
		'visible'=>Yii::app()->user->checkAccess('Cliente')
	);
}
$this->menu[]=array('label'=>'Fichas');
$this->menu[]=array('label'=>'Buscar', 'url'=>array('empresa/adminfichausu/'.$model->primaryKey));
$this->menu[]=array('label'=>'Volver', 'url'=>array($model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente'));

?>
<?php echo BsHtml::pageHeader($model->nombres.' '.$model->paterno.' '.$model->materno,'Supervisor') ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'Rut',
		'nombres',
		'paterno',
		'materno',
		'fono',
		'clasificacion',
		'countEvaluaciones'
	),
));?>
<?php $this->renderPartial('usuario/chart', array('model'=>$model)); ?>