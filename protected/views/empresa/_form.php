<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutEmpresa', "$('#Empresa_rut').Rut({
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
    <?= $form->textFieldControlGroup($model,'nombre'); ?>
    <?= $form->textFieldControlGroup($model,'razon_social'); ?>
    <?= $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
    <?= $form->dropDownListControlGroup($model,'com_id',CHtml::listData(Comuna::model()->findAll(),'com_id', 'com_nombre','reg_nombre'),array('empty' => 'Seleccione una comuna'));?>    
    <?= $form->dropDownListControlGroup($model,'clasificacion',array(
		'Sobre 100'=>Yii::t('Navbar','Sobre 100'),
		'Sobre 20'=>Yii::t('Navbar','Sobre 20'),
		'Sobre 10'=>Yii::t('Navbar','Sobre 10'),
		'Sobre 7'=>Yii::t('Navbar','Sobre 7'),
		'Sobre 6'=>Yii::t('Navbar','Sobre 6'),
		'Sobre 5'=>Yii::t('Navbar','Sobre 5'),
		'Letras'=>Yii::t('Navbar','Letras')
    ));?>
    <?= $form->textFieldControlGroup($model,'giro'); ?>
    <?= $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?= $form->textFieldControlGroup($model,'mail',array('rows'=>6)); ?>
    <?php # $form->textFieldControlGroup($model,'creado'); ?>
    <?php # $form->dropDownListControlGroup($model,'activa',array('SI','NO'));?>

    <?= BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>
