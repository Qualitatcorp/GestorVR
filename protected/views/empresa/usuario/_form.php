<?php
array_push($this->menu, 
    array('label'=>'Volver', 'url'=>array('view', 'id'=>$model->emp_id))
);
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutUsuario', "$('#EmpresaUsuario_rut').Rut({
        on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'empresa-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

    <?= $form->errorSummary($model); ?>
    <?php if ($this->action->id=='createUsu'): ?>
        <?php if (Yii::app()->user->checkAccess('Administrador')): ?>
        <?= $form->dropDownListControlGroup($model,'role',array(
            'Supervisor'=>'Supervisor',
            'Cliente'=>'Cliente',
            ));?>        
        <?php endif ?>
        <?= $form->textFieldControlGroup($model,'rut',array('maxlength'=>12)); ?>
        <?= $form->textFieldControlGroup($model,'email'); ?>
        <?= $form->textFieldControlGroup($model,'password'); ?>
    <?php endif ?>
    <?= $form->textFieldControlGroup($model,'nombres'); ?>
    <?= $form->textFieldControlGroup($model,'paterno'); ?>
    <?= $form->textFieldControlGroup($model,'materno'); ?>
    <?= $form->textFieldControlGroup($model,'fono'); ?>
        <?= $form->dropDownListControlGroup($model,'clasificacion',array(
    'Sobre 100'=>'Sobre 100',
    'Sobre 20'=>'Sobre 20',
    'Sobre 10'=>'Sobre 10',
    'Sobre 7'=>'Sobre 7',
    'Sobre 6'=>'Sobre 6',
    'Sobre 5'=>'Sobre 5',
    'Letras'=>'Letras'
            ));?>
    <?php
        if(!Yii::app()->user->checkAccess('Supervisor'))
            echo $form->checkBoxListControlGroup($model, 'disp', CHtml::listData($model->emp->dispositivos, 'dis_id', 'nombre'),array('checkAll'=>'Todos', 'checkAllLast'=>true));
    ?>
    <?= BsHtml::formActions(array(BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
    <?php if (Yii::app()->user->checkAccess('Administrador')&&$this->action->id=='updateUsu'): ?>    
        <?= BsHtml::formActions(array('<a href="'.Yii::app()->createUrl("cruge/ui/usermanagementupdate/",array("id"=>$model->usu_id)).'">Editar información sensible</a>'));?>
    <?php endif ?>

<?php $this->endWidget(); ?>