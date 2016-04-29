<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
?>

<?php
$this->breadcrumbs=array(
	'Trabajador',
	'Crear',
);?>

<?php echo BsHtml::pageHeader('Crear','Trabajador') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>