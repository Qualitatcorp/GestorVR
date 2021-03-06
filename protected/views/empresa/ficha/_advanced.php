<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'anvanced-form',
    // 'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); 
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutUsuario', "$('#RvFichaForm_trabajador').Rut({
        on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>
<div class="col-md-4">
    <?= $form->numberFieldControlGroup($model,'ficha',array('class' => BsHtml::INPUT_SIZE_SM,'min'=>1)); ?>
    <?= $form->textFieldControlGroup($model,'trabajador',array('class' => BsHtml::INPUT_SIZE_SM)); ?>
    <?= $form->dropDownListControlGroup($model,'evaluacion',Chtml::listData($model->evaluaciones, 'eva_id', 'nombre'),
     array(
    'empty' => 'Elija ...',
    'class' => BsHtml::INPUT_SIZE_SM
	));?>
</div>
<div class="col-md-4">
    <?= $form->dateFieldControlGroup($model,'inicio',array('class' => BsHtml::INPUT_SIZE_SM,'min'=>"2015-01-01")); ?>    
    <?= $form->numberFieldControlGroup($model,'limite',array('class' => BsHtml::INPUT_SIZE_SM)); ?>    
    <?= $form->dropDownListControlGroup($model,'order',array('t.creado desc'=>'Mayor a menor fecha','t.creado asc'=>'menor a mayor fecha','t.calificacion desc'=>'mayor a menor calificacion','t.calificacion asc'=>'menor a mayor calificacion'),
     array(
    'empty' => 'Elija ...',
    'class' => BsHtml::INPUT_SIZE_SM
	));?>
</div>
<div class="col-md-4">
    <?= $form->dateFieldControlGroup($model,'termino',array('class' => BsHtml::INPUT_SIZE_SM,'max'=>date("Y-m-d"))); ?>
    <?= $form->dropDownListControlGroup($model,'proyecto',Chtml::listData($model->proyectos, 'pro_id', 'nombre'),
     array(
    'empty' => 'Elija ...',
    'class' => BsHtml::INPUT_SIZE_SM
	));?>
    <?= $form->dropDownListControlGroup($model,'dispositivo',Chtml::listData($model->dispositivos, 'dis_id', 'alternativo'),
     array(
    'empty' => 'Elija ...',
    'class' => BsHtml::INPUT_SIZE_SM
	));?>
</div>

    <?= BsHtml::formActions(array(
        BsHtml::submitButton('Buscar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'pull' => BsHtml::PULL_RIGHT,'name'=>'find','value'=>"find")),
        BsHtml::submitButton('Excel', array('color' => BsHtml::BUTTON_COLOR_SUCCESS,'pull' => BsHtml::PULL_RIGHT,'name'=>'excel','value'=>"excel"))
        ));?>
<?php $this->endWidget(); ?>