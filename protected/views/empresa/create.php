<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
?>

<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	'Create',
);
?>

<?php echo BsHtml::pageHeader('Create','Empresa') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>