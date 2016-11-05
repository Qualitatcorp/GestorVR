<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
    ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
    ->registerScript('ValidaRutLogin', "$('#LoginForm_username').Rut({
    	on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");
?>
<style type="text/css">
	body {
    width:100px;
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
.middlePage {
	width: 680px;
    height: 500px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.logo {
	color:#CCC;
}
</style><link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>

<body>
<div class="middlePage">
<div class="page-header">
  <h1 class="logo"><img src="<?=Yii::app()->baseUrl ?>/images/logo.png" alt="Smiley face" height="100">Gestor VR <small>Qualitatcorp</small></h1>
</div>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Acceso a la plataforma <?= BsHtml::bold('Gestor VR');?></h3>
  </div>
  <div class="panel-body">
  
  <div class="row">
  
<div class="col-md-5" >
	<?= BsHtml::lead('Si desea conocer su evaluacion favor hacer click '.BsHtml::button('Aquí', array('color' => BsHtml::BUTTON_COLOR_LINK,'onclick'=>"location.href='Link Evaluacion'")));?>

</div>

    <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
<fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
)); ?>

<?= $form->textField($model, 'username', array('prepend' => BsHtml::icon(BsHtml::GLYPHICON_USER),'placeholder'=>'Rut','required'=>'required'));?><br>
<?= $form->passwordField($model, 'password', array('prepend' => BsHtml::icon(BsHtml::GLYPHICON_LOCK),'placeholder'=>'Contraseña','required'=>'required'));?>
<?= $form->checkBoxList($model, 'rememberMe', array(1=>"Recuerdame"));?>
<?= BsHtml::submitButton('Acceder', array('color' => BsHtml::BUTTON_COLOR_INFO,'pull' => BsHtml::PULL_RIGHT
));
?>
<?php $this->endWidget();?>
</fieldset>
</form>
</div>
    
</div>
    
</div>
</div>

</div>
</body>