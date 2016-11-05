<?php
$this->breadcrumbs=array(
	'Trabajador',
	'carga masiva',
);

echo BsHtml::pageHeader('Administrar','Trabajadores') ?>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
    <?= $form->errorSummary($model); ?>   
    <?= $form->fileFieldControlGroup($model,'file'); ?>
    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)),BsHtml::button('Descarga masiva Trabajadores',array('onClick'=>"window.open('downExcel')",
    'color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
    <?php $this->endWidget(); ?>