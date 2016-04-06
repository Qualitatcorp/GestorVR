<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
?>

<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model->usu_rut,
	'Modificar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Usuario', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
<?php echo BsHtml::pageHeader('Modificar','Usuario '.$model->usu_rut) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
  </div>
</div>