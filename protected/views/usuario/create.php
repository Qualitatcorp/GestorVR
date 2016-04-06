<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
?>

<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Usuario', 'url'=>array('admin')),
);
?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
<?php echo BsHtml::pageHeader('Crear','Usuario') ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
  </div>
</div>