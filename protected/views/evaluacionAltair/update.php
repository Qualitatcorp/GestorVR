<?php
/* @var $this EvaluacionAltairController */
/* @var $model EvaluacionAltair */
?>

<?php
$this->breadcrumbs=array(
	'Evaluacion Altairs'=>array('index'),
	$model->alt_id=>array('view','id'=>$model->alt_id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List EvaluacionAltair', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create EvaluacionAltair', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View EvaluacionAltair', 'url'=>array('view', 'id'=>$model->alt_id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage EvaluacionAltair', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','EvaluacionAltair '.$model->alt_id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>