<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->iduser,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List User', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create User', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update User', 'url'=>array('update', 'id'=>$model->iduser)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->iduser),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','User '.$model->iduser) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'iduser',
		'regdate',
		'actdate',
		'logondate',
		'username',
		'email',
		'password',
		'authkey',
		'state',
		'totalsessioncounter',
		'currentsessioncounter',
	),
)); ?>