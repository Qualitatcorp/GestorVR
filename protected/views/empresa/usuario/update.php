<?php
$this->breadcrumbs=array('Empresa','Usuario','Actualizar',$model->nombreCompleto);?>
<?php echo BsHtml::pageHeader('Actualizar','Usuario '.$model->nombreCompleto) ?>

<?php $this->renderPartial('usuario/_form', array('model'=>$model)); ?>