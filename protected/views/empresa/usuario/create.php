<?php
$this->breadcrumbs=array('Empresa','Usuario','Crear');?>
<?php echo BsHtml::pageHeader('Crear','Usuario '.Empresa::model()->findByPk($_GET['id'])->nombre) ?>

<?php $this->renderPartial('usuario/_form', array('model'=>$model)); ?>