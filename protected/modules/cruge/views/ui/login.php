<?php
// $baseUrl=Yii::app()->baseUrl;
// Yii::app()->getClientScript()
//     ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
//     ->registerScript('ValidaRutLogin', "$('#CrugeLogon_username').Rut({
//     	on_error: function(){ alert('El rut ingresado es incorrecto'); }
// })
// ");
?>
<style type="text/css">
	body {
    /*width:100px;*/
	height:100px;
  background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
font-family: 'Raleway', sans-serif;
}

p {
	color:#CCC;
}

.spacing {
	padding-top:7px;
	padding-bottom:7px;
}
/*.middlePage {
	width: 680px;
    height: 500px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}*/

.logo {
	color:#CCC;
}


</style><link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
<body>
<div class="container col-md-6 col-md-offset-3">
  
<div class="middlePage">
<div class="page-header">
  <h1 class="logo">
    <img  src="<?=Yii::app()->baseUrl ?>/images/logo.png" alt="Qualitatcorp" height="50">
    <small>Gestor VR</small>
  </h1>
</div>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><?=ucfirst(CrugeTranslator::t('logon', 'Access platform'))?><?= BsHtml::bold(' Gestor VR');?></h3>
  </div>
<div class="panel-body">
<!--   <div class="col-md-5" >
    <?= BsHtml::lead('Sí desea conocer su evaluación, solo debe ingresar el RUT, dejando en blanco la contraseña. ');?>
  </div> -->
  <div class="col-md-12">
    <fieldset>
    <?php if(Yii::app()->user->hasFlash('loginflash')): ?>
    <div class="flash-error">
      <?php echo Yii::app()->user->getFlash('loginflash'); ?>
    </div>
    <?php else: ?>
    <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        // 'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
        'enableClientValidation'=>true,
    )); ?>
    <label class="control-label"><?=ucfirst(CrugeTranslator::t('logon', 'User')) ?></label>
    <?= $form->textField($model, 'username', array('prepend' => BsHtml::icon(BsHtml::GLYPHICON_USER),'placeholder'=>'Rut','required'=>'required'));?><br>
    <?= $form->passwordField($model, 'password', array('prepend' => BsHtml::icon(BsHtml::GLYPHICON_LOCK),'placeholder'=>'Contraseña','required'=>'required'));?>
    <?php echo $form->error($model,'password'); ?>
    <?= $form->checkBoxControlGroup($model, 'rememberMe');?>
    <?php if(isset(Yii::app()->session['lang']))$model->language=Yii::app()->session['lang'];?>
    <?= $form->dropDownListControlGroup($model,'language',Yii::app()->params['language'])?>
    <?= BsHtml::submitButton(ucfirst(CrugeTranslator::t('logon', 'Login')), array('color' => BsHtml::BUTTON_COLOR_INFO,'pull' => BsHtml::PULL_RIGHT));?>
    <?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
    <?php if(Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1)
        echo Yii::app()->user->ui->registrationLink;?>
    <?php $this->endWidget();?>
    <?php endif; ?>
    </fieldset>
  </div>
</div>
    
</div>
</div>
</div>
</body>
