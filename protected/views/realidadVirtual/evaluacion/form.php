<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con un <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model,'tev_id', CHtml::listData(RvTipo::model()->findAll("activo='SI'"),'tev_id', 'nombre'), array('empty' => 'Seleccione un tipo de evaluación.'));?>    
    <?php if($this->action->id!='createEva')echo $form->dropDownListControlGroup($model,'habilitado',array('SI'=>'SI','NO'=>'NO'));?>
    <?php echo $form->textFieldControlGroup($model,'nombre'); ?>
    <?php echo $form->textAreaControlGroup($model,'descripcion'); ?>
    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>