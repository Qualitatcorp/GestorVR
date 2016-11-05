<?php
$this->breadcrumbs=array(
	'Trabajador',
	$model->rut,
	'Editar',
);

$this->menu=array(
	array('label'=>'Crear Trabajador', 'url'=>array('trabajadorCreate')),
);
?>

<?php echo BsHtml::pageHeader('Update','Trabajador '.$model->tra_id) ?>
<?php $this->renderPartial('/trabajador/_form', array('model'=>$model)); ?>