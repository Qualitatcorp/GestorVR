<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
?>

<?php
$this->breadcrumbs=array(
	'Empresas',
	'Crear',
);
?>

<?php echo BsHtml::pageHeader('Crear','Empresa') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>