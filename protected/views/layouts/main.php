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
		->registerScriptFile($baseUrl.'/js/bootstrap.js',CClientScript::POS_END);
	?>
    <link rel="icon" type="image/png" href="<?=$baseUrl ?>/images/favicon.png" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container">    <?php
$this->widget('bootstrap.widgets.BsNavbar', array(
    'collapse' => true,
    'brandLabel' => BsHtml::icon(BsHtml::GLYPHICON_GLOBE).BsHtml::bold(' Gestor VR').BsHtml::small(' Qualitatcorp'),
    'brandUrl' => Yii::app()->homeUrl,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.BsNav',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array(
                    'label' => 'Sistema',
                    // 'visible'=>Yii::app()->user->checkAccess('action_empresa_create'),
                    'items' => array(
                        // BsHtml::menuHeader(BsHtml::italics('Usuarios')),
                        // array('label' => 'Administar Usuarios','url' => array('/usuario/admin')),
                        // array('label' => 'Crear Usuario','url' => array('/usuario/create')),
                        // array('label' => 'Registros de ingreso','url' => array('/usuario/records')),
                        // BsHtml::menuDivider().
                        BsHtml::menuHeader(BsHtml::italics('Empresa')),
                        array('label' => 'Administrar Empresas','url' => array('//empresa/admin')),
                        array('label' => 'Crear Empresa','url' => array('//empresa/create')),
                        BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Trabajador')),
                        array('label' => 'Administrar trabajador','url' => array('//trabajador/admin')),
                        array('label' => 'Crear trabajador','url' => array('//trabajador/create')),
                    )
                ),
                array(
                    'label' => 'Evaluacion',
                    'items' => array(
                        BsHtml::menuHeader(BsHtml::italics('Realidad Virtual')),
                        array('label' => 'Buscar Evaluación','url' => array('/RealidadVirtual/adminFicha')),
                        // array('label' => 'Buscar Ficha Persona','url' => array('/RealidadVirtual/admin')),
                        (Yii::app()->user->checkAccess('action_evaluacionAltair_admin'))?
                            BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Entrenador de Gases')):"",
                        array(
                            'label' => 'Buscar Evaluación',
                            'url' => array('/EvaluacionAltair/admin'),
                            'visible'=>Yii::app()->user->checkAccess('action_evaluacionAltair_admin')
                        ),
                        BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Administrar Evaluación')),
                        array('label' => 'Tipo Evaluación','url' => array('/RealidadVirtual/adminTipo')),
                        array('label' => 'Crear Evaluación','url' => array('/RealidadVirtual/createEva')),
                        array('label' => 'Buscar Evaluación','url' => array('/RealidadVirtual/adminEva')),
                    )
                ),                
                array(
                    'label' => 'Dispositivo',
                    'items' => array(
                        BsHtml::menuHeader(BsHtml::italics('Dispositivos')),
                        array('label' => 'Crear','url' => array('/Dispositivo/createDisp')),
                        array('label' => 'Buscar','url' => array('/Dispositivo/adminDisp')),

                        BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Tipo de dispositivo')),
                        array('label' => 'Crear','url' => array('/Dispositivo/createTipo')),
                        array('label' => 'Buscar','url' => array('/Dispositivo/adminTipo')),
                    )
                ),                
                array(
                    'label' => 'Licencia',
                    'items' => array(
                        BsHtml::menuHeader(BsHtml::italics('Licencia')),
                        array('label' => 'Crear','url' => array('/Licencia/createTipo')),
                        array('label' => 'Registros','url' => array('/Licencia/viewRecords')),
                        BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Empresa')),
                        array('label' => ' Asignar','url' => array('/Licencia/create')),
                        array('label' => 'Buscar','url' => array('/Licencia/view')),
                    )
                ),
            )
        ),
        array(
            'class' => 'bootstrap.widgets.BsNav',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array(
                    'label'=>'Administrar Usuarios', 
                    'url'=>Yii::app()->user->ui->userManagementAdminUrl, 
                    'visible'=>Yii::app()->user->isSuperAdmin
                ),
                array('label'=>'Login', 'url'=>Yii::app()->user->ui->loginUrl, 'visible'=>Yii::app()->user->isGuest),
                array('label' =>'Logout ('.Yii::app()->user->name.')','pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT,'url' => array('//site/logout'),'visible' => !Yii::app()->user->isGuest)
            ),
            'htmlOptions' => array(
                'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT
            )
        )
        
    )
));
?>
		 <?php 
		// breadcrumbs
			$this->widget('bootstrap.widgets.BsBreadCrumb', array(
				'links' => $this->breadcrumbs,
				// will change the container to ul
				'tagName' => 'ul',
				// will generate the clickable breadcrumb links
				'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
				// will generate the current page url : <li>News</li>
				'inactiveLinkTemplate' => '<li>{label}</li>',
				// will generate your homeurl item : <li><a href="/dr/dr/public_html/">Home</a></li>
				'homeLink' => BsHtml::openTag('li') . BsHtml::icon(BsHtml::GLYPHICON_HOME) . BsHtml::closeTag('li')
			));
	?>
<div class="content">
	<?php echo $content ?>
</div>
</div>
<?=Yii::app()->user->ui->displayErrorConsole(); ?>
</body>
</html>