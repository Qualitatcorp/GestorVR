<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con un <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>    
    <?= $form->dropDownListControlGroup($model,'emp_id',
    	CHtml::listData(Empresa::model()->findAll(), 
                'emp_id', 'nombre'),array('empty' => 'Seleccione la Empresa'));?>   
    <?= $form->dropDownListControlGroup($model,'lit_id',
    	CHtml::listData(LicTipo::model()->findAll(),'lit_id', 'nombre'),array('empty' => 'Seleccione la licencia'));?>
    <?php echo $form->textAreaControlGroup($model,'descripcion'); ?>
    <?php echo $form->dateFieldControlGroup($model,'creado'); ?>  
    <?php echo $form->numberFieldControlGroup($model,'cantidad'); ?>  

    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>