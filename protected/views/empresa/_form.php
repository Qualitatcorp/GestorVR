<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'empresa-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

    <?= $form->errorSummary($model); ?>
    <?= $form->textFieldControlGroup($model,'nombre'); ?>
    <?= $form->textFieldControlGroup($model,'razon_social'); ?>
    <?= $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
    <?= $form->dropDownListControlGroup($model,'com_id',CHtml::listData(Comuna::model()->findAll(),'com_id', 'com_nombre','reg_nombre'),array('empty' => 'Seleccione una comuna'));?>
    <?= $form->textFieldControlGroup($model,'giro'); ?>
    <?= $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?= $form->textFieldControlGroup($model,'mail',array('rows'=>6)); ?>
    <?= $form->textFieldControlGroup($model,'creado'); ?>
    <?= $form->dropDownListControlGroup($model,'activa',array('SI','NO'));?>

    <?= BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>
