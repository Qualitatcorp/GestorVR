<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
?>

<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->emp_id=>array('view','id'=>$model->emp_id),
	'Update',
);
?>

<?php echo BsHtml::pageHeader('Update','Empresa '.$model->emp_id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>