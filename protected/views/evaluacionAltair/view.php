<?php
/* @var $this EvaluacionAltairController */
/* @var $model EvaluacionAltair */
?>

<?php
$this->breadcrumbs=array(
	'Evaluacion Altairs'=>array('index'),
	$model->alt_id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List EvaluacionAltair', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create EvaluacionAltair', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update EvaluacionAltair', 'url'=>array('update', 'id'=>$model->alt_id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete EvaluacionAltair', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->alt_id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage EvaluacionAltair', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','EvaluacionAltair '.$model->alt_id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'alt_id',
		'tra_id',
		'iduser',
		'nota',
		'creado',
	),
)); ?>