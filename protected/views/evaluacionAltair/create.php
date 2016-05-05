<?php
/* @var $this EvaluacionAltairController */
/* @var $model EvaluacionAltair */
?>

<?php
$this->breadcrumbs=array(
	'Evaluacion Altairs'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List EvaluacionAltair', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage EvaluacionAltair', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','EvaluacionAltair') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>