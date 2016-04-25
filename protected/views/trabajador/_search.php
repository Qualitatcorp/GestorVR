<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'tra_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'nombre',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'paterno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'materno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'nacimiento'); ?>
    <?php echo $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?php echo $form->textAreaControlGroup($model,'mail',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'creacion'); ?>
    <?php echo $form->textFieldControlGroup($model,'modificado'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
