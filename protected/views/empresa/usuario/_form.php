<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutUsuario', "$('#Usuario_rut').Rut({
        on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'empresa-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

    <?= $form->errorSummary($model); ?>
    <?= $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
    <?= $form->textFieldControlGroup($model,'email'); ?>
    <?= $form->textFieldControlGroup($model,'password'); ?>
    <?= $form->textFieldControlGroup($model,'nombres'); ?>
    <?= $form->textFieldControlGroup($model,'paterno'); ?>
    <?= $form->textFieldControlGroup($model,'materno'); ?>
    <?= $form->textFieldControlGroup($model,'fono'); ?>
    <?= BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>