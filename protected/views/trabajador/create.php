<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
?>

<?php
$this->breadcrumbs=array(
	'Trabajadors'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Trabajador', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Trabajador', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Trabajador') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>