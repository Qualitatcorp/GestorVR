<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutTrabajador', "$('#Trabajador_rut').Rut({
        on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'trabajador-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'rut',array('maxlength'=>150)); ?>    
    <?php echo $form->textFieldControlGroup($model,'nombre',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'paterno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'materno',array('maxlength'=>100)); ?>
    <?php echo $form->dateFieldControlGroup($model,'nacimiento'); ?>
    <?php echo $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'mail',array('rows'=>6)); ?>

    <?= BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>
