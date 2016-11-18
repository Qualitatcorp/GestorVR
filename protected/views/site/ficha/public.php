<div class="col-md-6 col-md-offset-3">
<?php echo BsHtml::pageHeader('Ficha') ?>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'empresa-form',
    // 'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

<?= $form->errorSummary($model); ?>
<?php
if(!isset($_GET['id']))
	echo $form->numberFieldControlGroup($model,'number');
?>
<?php
if($model->international)
	echo $form->dropDownListControlGroup($model,'language',Yii::app()->params['language']/*,array('empty' => 'Select...')*/);
?>
<?= $form->dropDownListControlGroup($model,'type',array('HTML'=>Yii::t('app','WEB'),'PDF'=>'PDF')/*,array('empty' => 'Select...')*/);?>
<?php $this->widget('ext.recaptcha.ReCaptcha', array(
    'model'     => $model,
    'attribute' => 'captcha',
));?>
<?= BsHtml::submitButton(Yii::t('app','Submit'), array('color' => BsHtml::BUTTON_COLOR_PRIMARY));?>
<?php $this->endWidget(); ?>
</div>