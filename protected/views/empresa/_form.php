<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'empresa-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textAreaControlGroup($model,'nombre',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'com_id'); ?>
    <?php echo $form->textAreaControlGroup($model,'razon_social',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'giro'); ?>
    <?php echo $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?php echo $form->textAreaControlGroup($model,'mail',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'creado'); ?>
    <?php echo $form->textFieldControlGroup($model,'activa',array('maxlength'=>2)); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
