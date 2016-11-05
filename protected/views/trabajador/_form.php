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
    // 'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

<fieldset>
    <legend>Trabajador</legend>
    <div class="row">
    <?php echo $form->errorSummary($model); ?>
        <div class="col-md-6">
			<?php echo $form->textFieldControlGroup($model,'rut',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>150)); ?>    
			<?php echo $form->textFieldControlGroup($model,'paterno',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>100)); ?>
			<?php echo $form->dateFieldControlGroup($model,'nacimiento',array('class' => BsHtml::INPUT_SIZE_SM,)); ?>
			<?php echo $form->numberFieldControlGroup($model,'hijos',array('class' => BsHtml::INPUT_SIZE_SM,'min'=>0,"max"=>50)); ?>
			<?php echo $form->emailFieldControlGroup($model,'mail',array('class' => BsHtml::INPUT_SIZE_SM)); ?>
        </div>        
        <div class="col-md-6">
			<?php echo $form->textFieldControlGroup($model,'nombre',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>150,)); ?>
			<?php echo $form->textFieldControlGroup($model,'materno',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>100)); ?>
			<?php echo $form->dropDownListControlGroup($model,'estado_civil',array(
				'SOLTERO/A'=>'SOLTERO/A',
				'CASADO/A'=>'CASADO/A',
				'VIUDO/A'=>'VIUDO/A',
				'DIVORCIADO/A'=>'DIVORCIADO/A',
				'SEPARADO/A'=>'SEPARADO/A',
				'CONVIVIENTE'=>'CONVIVIENTE',
			),array('empty' => 'Seleccione ...','class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>100)); ?>
			<?php echo $form->textFieldControlGroup($model,'fono',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>50)); ?>
        </div>
    </div>
    </fieldset>
    <fieldset>
    <legend>Laboral</legend>
    <div class="row">
    	<div class="col-md-6">
		    <?php echo $form->textFieldControlGroup($model,'gerencia',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>128)); ?>
		    <?php echo $form->textFieldControlGroup($model,'cargo',array('class' => BsHtml::INPUT_SIZE_SM,'maxlength'=>64)); ?>
    	</div>
    	<div class="col-md-6">
    		<?php echo $form->numberFieldControlGroup($model,'antiguedad',array('class' => BsHtml::INPUT_SIZE_SM,'min'=>0,"max"=>70)); ?>
    	</div>
    </div>
    		
 </fieldset>
    <?= BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY));?>

<?php $this->endWidget(); ?>
