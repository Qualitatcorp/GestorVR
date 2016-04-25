<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'trabajador-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nombre',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'paterno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'materno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'nacimiento'); ?>
    <?php echo $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?php echo $form->textAreaControlGroup($model,'mail',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'creacion'); ?>
    <?php echo $form->textFieldControlGroup($model,'modificado'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
