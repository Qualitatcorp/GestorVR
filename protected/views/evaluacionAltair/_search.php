<?php
/* @var $this EvaluacionAltairController */
/* @var $model EvaluacionAltair */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'alt_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'tra_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'iduser'); ?>
    <?php echo $form->textFieldControlGroup($model,'nota',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'creado'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
