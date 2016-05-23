<?php $this->breadcrumbs=array('Evaluación realidad virtual','Pregunta','Crear',);?>
<?php echo BsHtml::pageHeader('Crear pregunta',RvEvaluacion::model()->findByPk($model->eva_id)->nombre); ?>
<?php $this->renderPartial('pregunta/form', array('model'=>$model,'list'=>$list)); ?>