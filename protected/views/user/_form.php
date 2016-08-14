<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'regdate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'actdate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'logondate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>45)); ?>
    <?php echo $form->passwordFieldControlGroup($model,'password',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'authkey',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'state'); ?>
    <?php echo $form->textFieldControlGroup($model,'totalsessioncounter'); ?>
    <?php echo $form->textFieldControlGroup($model,'currentsessioncounter'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
