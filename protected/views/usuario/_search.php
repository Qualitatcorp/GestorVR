<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'usu_rut',array('maxlength'=>13)); ?>
    <?php echo $form->textFieldControlGroup($model,'emp_rut',array('maxlength'=>13)); ?>
    <?php echo $form->textFieldControlGroup($model,'car_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_nombre',array('maxlength'=>256)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_apellido',array('maxlength'=>512)); ?>
        <?php echo $form->textFieldControlGroup($model,'usu_rol',array('maxlength'=>32)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_fono',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_email',array('maxlength'=>256)); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_fecha_creacion'); ?>
    <?php echo $form->textFieldControlGroup($model,'usu_desabilitado'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
