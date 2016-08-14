<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'iduser'); ?>
    <?php echo $form->textFieldControlGroup($model,'regdate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'actdate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'logondate',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>45)); ?>
        <?php echo $form->textFieldControlGroup($model,'authkey',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'state'); ?>
    <?php echo $form->textFieldControlGroup($model,'totalsessioncounter'); ?>
    <?php echo $form->textFieldControlGroup($model,'currentsessioncounter'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
