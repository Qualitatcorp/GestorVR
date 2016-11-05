<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
?>

<?php
$this->breadcrumbs=array(
	'Trabajador',
	$model->rut,
	'Editar',
);

// $this->menu=array(
//     array('icon' => 'glyphicon glyphicon-list','label'=>'List Trabajador', 'url'=>array('index')),
// 	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Trabajador', 'url'=>array('create')),
//     array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Trabajador', 'url'=>array('view', 'id'=>$model->tra_id)),
//     array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Trabajador', 'url'=>array('admin')),
// );
?>

<?php echo BsHtml::pageHeader('Editar','Trabajador '.$model->tra_id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>