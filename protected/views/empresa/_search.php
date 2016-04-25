<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'emp_id'); ?>
    <?php echo $form->textAreaControlGroup($model,'nombre',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'com_id'); ?>
    <?php echo $form->textAreaControlGroup($model,'razon_social',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'giro'); ?>
    <?php echo $form->textFieldControlGroup($model,'fono',array('maxlength'=>50)); ?>
    <?php echo $form->textAreaControlGroup($model,'mail',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'creado'); ?>
    <?php echo $form->textFieldControlGroup($model,'activa',array('maxlength'=>2)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
