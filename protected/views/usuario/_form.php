<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRut', "$('#Usuario_usu_rut').Rut({
   on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con un <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'usu_rut',array('maxlength'=>13)); ?>
    <?php echo $form->dropDownListControlGroup($model,'emp_rut', CHtml::listData(Empresa::model()->findAll('emp_desabilitado=0'),'emp_rut', 'emp_nombre'), array('empty' => 'Seleccione una empresa'));?>
    <?php echo $form->dropDownListControlGroup($model,'car_id', CHtml::listData(Cargo::model()->findAll('car_desabilitado=0'),'car_id', 'car_nombre'), array('empty' => 'Seleccione un Cargo'));?>
    <?php echo $form->textFieldControlGroup($model,'usu_nombre',array('maxlength'=>256)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_apellido',array('maxlength'=>512)); ?>
    <?php echo $form->passwordFieldControlGroup($model,'usu_password',array('maxlength'=>128)); ?>
    <?php echo $form->dropDownListControlGroup($model,'usu_rol', array('admins'=>'Administrador','users'=>'Usuario','viewver'=>'Observador'), array('empty' => 'Seleccione un Cargo'));?>
    <?php echo $form->textFieldControlGroup($model,'usu_fono',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_email',array('maxlength'=>256)); ?>
    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>
