<?php
$this->breadcrumbs=array(
	'Evaluacion Altairs'=>array('index'),
	'Create',
);?>
<?php echo BsHtml::pageHeader('Crear','Usuario '.Empresa::model()->findByPk($_GET['id'])->nombre) ?>

<?php $this->renderPartial('usuario/_form', array('model'=>$model)); ?>