<?php
$this->breadcrumbs=array('Evaluación','Análisis');
// if(Yii::app()->user->checkAccess('Cliente')){
// 	$this->menu[]=array('label'=>'Usuario');
// 	$this->menu[]=array('label'=>'Modificar', 'url'=>array('updateUsu', 'id'=>$model->primaryKey));
// 	$this->menu[]=array(
// 		'label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array(
// 			'submit'=>array('deleteUsu','id'=>$model->primaryKey),
// 			'confirm'=>'¿Estas seguro que deseas eliminar este usuario?'),
// 		'visible'=>Yii::app()->user->checkAccess('Cliente')
// 	);
// }
// $this->menu[]=array('label'=>'Fichas');
// $this->menu[]=array('label'=>'Buscar', 'url'=>array('empresa/adminfichausu/'.$model->primaryKey));
// $this->menu[]=array('label'=>'Volver', 'url'=>array($model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente'));

?>
<?php echo BsHtml::pageHeader('Evaluación',$model->nombre) ?>
<?php 
$eva=$model->evaluaciones;
if (!empty($eva)): ?>
<?php foreach ($eva as $evaluacion): ?>
<?php $this->beginWidget('bootstrap.widgets.BsPanel',array('title'=>$evaluacion->nombre,/*'htmlOptions'=>array('class'=>"panel panel-default",'role'=>'tablist')*/));?>
<?php $this->renderPartial('evaluacion/chart', array('model'=>RvEvaluacion::findByEmpresa($model->primaryKey,$evaluacion->primaryKey))); ?>
<?php $this->endWidget();?>
<?php endforeach ?>
<?php else: ?>
<p>No existen evaluaciones</p>	
<?php endif ?>