
<?php echo BsHtml::pageHeader('Buscar Trabajador'); ?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_INLINE,
    'enableAjaxValidation' => true,
    'id' => 'user_form_inline',
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));
?>
<fieldset>
    <legend>Trabajador</legend>
    <?php
echo $form->textFieldControlGroup($model, 'rut');
?>
    <?php
echo BsHtml::submitButton('Buscar', array(
    'color' => BsHtml::BUTTON_COLOR_PRIMARY
));
?>
</fieldset>
<?php
$this->endWidget();
?>

<?php if ($model->validate()): ?>
    <?php 
array_push($this->menu, 
    array('label'=>'Trabajador'),
    array('label'=>'Editar', 'url'=>array('trabajadorUpdate', 'id'=>$model->primaryKey),'visible'=>Yii::app()->user->checkAccess('Cliente'))
);
 ?>
    <?php $this->renderPartial('trabajador/view',array('model'=>$model,'empresa'=>$empresa)); ?>
<?php endif ?>