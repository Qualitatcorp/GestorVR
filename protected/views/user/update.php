<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->iduser=>array('view','id'=>$model->iduser),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List User', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create User', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View User', 'url'=>array('view', 'id'=>$model->iduser)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','User '.$model->iduser) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>