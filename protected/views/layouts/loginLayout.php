<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
    $baseUrl = Yii::app()->baseUrl; 
	Yii::app()->getClientScript()
		->registerCssFile($baseUrl.'/css/bootstrap.cerulean.min.css')
		->registerCoreScript('jquery')
		->registerScriptFile($baseUrl.'/js/bootstrap.js',CClientScript::POS_END)
        ->registerScriptFile($baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END)
        ->registerScript('ValidaRut', "$('#Usuario_usu_rut').Rut({
   on_error: function(){ alert('El rut ingresado es incorrecto'); }
})
");

	?>
    <link rel="icon" type="image/png" href="<?=$baseUrl ?>/images/favicon.png" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container">
<div class="content">
	<?php echo $content ?>
</div>
</div>

</body>
</html>