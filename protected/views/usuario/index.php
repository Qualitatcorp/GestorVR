<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Usuarios',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Usuario', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Usuarios') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>