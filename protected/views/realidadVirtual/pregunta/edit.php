<?php $this->breadcrumbs=array('Evaluación realidad virtual','Pregunta','Editar',);?>
<?php echo BsHtml::pageHeader('Editar pregunta',RvEvaluacion::model()->findByPk($model->eva_id)->nombre); ?>
<?php $this->renderPartial('pregunta/form', array('model'=>$model)); ?>
