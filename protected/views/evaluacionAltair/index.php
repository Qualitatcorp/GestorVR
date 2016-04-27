<?php
/* @var $this EvaluacionAltairController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Evaluacion Altairs',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create EvaluacionAltair', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage EvaluacionAltair', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Evaluacion Altairs') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>