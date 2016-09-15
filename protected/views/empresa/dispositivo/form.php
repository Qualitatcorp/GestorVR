<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con un <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nombre'); ?>
    <?php if (Yii::app()->user->isSuperAdmin||Yii::app()->user->checkAccess('Adminsitrador')): ?>
    <?php echo $form->dropDownListControlGroup($model,'dit_id', CHtml::listData(DispositivoTipo::model()->findAll(),'dit_id', 'nombre'), array('empty' => 'Seleccione un tipo de dispositivo.'));?>
    <?php echo $form->dropDownListControlGroup($model,'habilitado',array('NO'=>'NO','SI'=>'SI'));?>
    <?php echo $form->dropDownListControlGroup($model,'activado', array('NO'=>'NO','SI'=>'SI'));?>    
    <?php echo $form->textFieldControlGroup($model,'keycode',array('disabled' => true)); ?>
    <?php endif ?>
    <?php echo $form->textFieldControlGroup($model,'serial'); ?>
    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>