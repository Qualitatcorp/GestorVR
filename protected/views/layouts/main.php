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
	    ->registerCssFile($baseUrl.'/css/ie10-viewport-bug-workaround.css')
		->registerCoreScript('jquery')
		->registerScriptFile($baseUrl.'/js/bootstrap.js',CClientScript::POS_END)    ->registerCssFile($baseUrl.'/css/offcanvas.css')
	    ->registerScriptFile($baseUrl.'/js/ie10-viewport-bug-workaround.js',CClientScript::POS_END)
	    ->registerScriptFile($baseUrl.'/js/offcanvas.js',CClientScript::POS_END);
	$flashMessages = Yii::app()->user->getFlashes();
	if ($flashMessages) {
		Yii::app()->getClientScript()
			->registerCssFile($baseUrl.'/css/toastr.min.css')
			->registerScriptFile($baseUrl.'/js/toastr.min.js',CClientScript::POS_END);
		foreach($flashMessages as $key => $message) {

			Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $key, "toastr['{$key}']('{$message}');",CClientScript::POS_END);
		}
	}

	?>
	<link rel="icon" type="image/png" href="<?=$baseUrl ?>/images/favicon.png" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container">    
<?php 
$menu=array();
if(Yii::app()->user->checkAccess('Cliente')&&!Yii::app()->user->isSuperAdmin&&!Yii::app()->user->checkAccess('Adminsitrador')){
	$emp_id=EmpresaUsuario::findByID()->emp_id;
	$menu[]=array(
			'label' => Yii::t('Navbar','Empresa'),
			'items' => array(
				array('label' => Yii::t('Navbar','Resumen'),'url' => array('//empresa/'.$emp_id)),
				)
			);
	$menu[]=array(
			'label' => Yii::t('Navbar','Usuario'),
			'items' => array(
				array('label' => Yii::t('Navbar','Crear'),'url' => array('//empresa/createUsu/'.$emp_id)),
			)
		);
	$menu[]=array(
			'label' => Yii::t('Navbar','Trabajador'),
			'items' => array(
				array('label' => Yii::t('Navbar','Crear'),'url' => array('//trabajador/create')),
				array('label' => Yii::t('Navbar','Buscar'),'url' => array('//empresa/trabajador')),
				array('label' => Yii::t('Navbar','Carga Masiva'),'url' => array('//trabajador/loadExcel')),
			)
		);
	$menu[]=array(
			'label' => Yii::t('Navbar','Ficha de Evaluación'),
			'items' => array(
				array('label' => Yii::t('Navbar','Resumen'),'url' => array('//empresa/evaluacion/'.$emp_id)),	
				array('label' => Yii::t('Navbar','Buscar'),'url' => array('//empresa/adminFicha/'.$emp_id)),	
			)
		);
}else if(Yii::app()->user->checkAccess('Supervisor')&&!Yii::app()->user->isSuperAdmin){
	$emu_id=EmpresaUsuario::findByID()->primaryKey;	
	$menu[]=array(
		'label' => Yii::t('Navbar','Supervisor'),
		'items' => array(
			array('label' => Yii::t('Navbar','Resumen'),'url' => array('//empresa/usu/'.$emu_id)),
			)
		);	
	$menu[]=array(
			'label' => Yii::t('Navbar','Trabajador'),
			'items' => array(
				array('label' => Yii::t('Navbar','Crear'),'url' => array('//trabajador/create')),
				array('label' => Yii::t('Navbar','Carga Masiva'),'url' => array('//trabajador/loadExcel')),
			)
		);	
	$menu[]=array(
			'label' => Yii::t('Navbar','Ficha de Evaluación'),
			'items' => array(
				array('label' => Yii::t('Navbar','Buscar'),'url' => array('//empresa/adminFichaUsu/'.$emu_id)),	
			)
		);
}else if(Yii::app()->user->checkAccess('Administrador')&&!Yii::app()->user->isSuperAdmin){
	$menu[]=array(
				'label' => Yii::t('Navbar','Sistema'),

				'items' => array(
					BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Empresa'))),
					array('label' => Yii::t('Navbar','Administrar'),'url' => array('//empresa/admin')),
					array('label' => Yii::t('Navbar','Crear'),'url' => array('//empresa/create')),
					BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Trabajador'))),
					array('label' => Yii::t('Navbar','Administrar'),'url' => array('//trabajador/admin')),
					array('label' => Yii::t('Navbar','Crear'),'url' => array('//trabajador/create')),
					array('label' => Yii::t('Navbar','Carga Masiva'),'url' => array('//trabajador/loadExcel')),
				)
			);
	$menu[]=array(
				'label' => Yii::t('Navbar','Evaluacion'),
				'items' => array(
					BsHtml::menuHeader(BsHtml::italics('Realidad Virtual')),
					array('label' => Yii::t('Navbar','Buscar'),'url' => array('//empresa/adminFicha/')),
					// array('label' => 'Buscar Ficha Persona','url' => array('/RealidadVirtual/admin')),
					// (Yii::app()->user->checkAccess('action_evaluacionAltair_admin'))?
					// 	BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Entrenador de Gases')):"",
					// array(
					// 	'label' => Yii::t('Navbar','Buscar'),
					// 	'url' => array('/EvaluacionAltair/admin'),
					// 	'visible'=>Yii::app()->user->checkAccess('action_evaluacionAltair_admin')
					// ),
					BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Administrar Evaluación')),
					array('label' => Yii::t('Navbar','Tipo'),'url' => array('/RealidadVirtual/adminTipo')),
					array('label' => Yii::t('Navbar','Crear'),'url' => array('/RealidadVirtual/createEva')),
					array('label' => Yii::t('Navbar','Buscar'),'url' => array('/RealidadVirtual/adminEva')),
				)
			);
	$menu[]=array(
					'label' => Yii::t('Navbar','Dispositivo'),
					'items' => array(
						BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Dispositivo'))),
						array('label' => Yii::t('Navbar','Crear'),'url' => array('/Dispositivo/createDisp')),
						array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Dispositivo/adminDisp')),

						BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Tipo de dispositivo')),
						array('label' => Yii::t('Navbar','Crear'),'url' => array('/Dispositivo/createTipo')),
						array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Dispositivo/adminTipo')),
					)
				);
	$menu[]=array(
					'label' => Yii::t('Navbar','Licencia'),
					'items' => array(
						BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Licencia'))),
						array('label' => Yii::t('Navbar','Crear'),'url' => array('/Licencia/createTipo')),
						// array('label' => 'Registros','url' => array('/Licencia/viewRecords')),
						BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Empresa'))),
						array('label' => Yii::t('Navbar','Asignar'),'url' => array('/Licencia/create')),
						// array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Licencia/view')),
					)
				);
}




$this->widget('bootstrap.widgets.BsNavbar', array(
	'collapse' => true,
	'brandLabel' => BsHtml::icon(BsHtml::GLYPHICON_GLOBE).BsHtml::bold(' Gestor VR').BsHtml::small(' Qualitat'),
	'brandUrl' => Yii::app()->homeUrl,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.BsNav',
			'type' => 'navbar',
			'activateParents' => true,
			'items' => $menu,
			// array(				
			// 	array(
			// 		'label' => 'Sistema',
			// 		'visible'=>Yii::app()->user->checkAccess('Adminsitrador')||Yii::app()->user->isSuperAdmin,
			// 		'items' => array(
			// 			// BsHtml::menuHeader(BsHtml::italics('Usuarios')),
			// 			// array('label' => 'Administar Usuarios','url' => array('/usuario/admin')),
			// 			// array('label' => 'Crear Usuario','url' => array('/usuario/create')),
			// 			// array('label' => 'Registros de ingreso','url' => array('/usuario/records')),
			// 			// BsHtml::menuDivider().
			// 			BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Empresa'))),
			// 			array('label' => 'Administrar Empresas','url' => array('//empresa/admin')),
			// 			array('label' => 'Crear Empresa','url' => array('//empresa/create')),
			// 			BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Trabajador'))),
			// 			array('label' => 'Administrar trabajador','url' => array('//trabajador/admin')),
			// 			array('label' => 'Crear trabajador','url' => array('//trabajador/create')),
			// 		)
			// 	),
			// 	array(
			// 		'label' => 'Evaluacion',
			// 		'visible'=>Yii::app()->user->checkAccess('Adminsitrador')||Yii::app()->user->isSuperAdmin,
			// 		'items' => array(
			// 			BsHtml::menuHeader(BsHtml::italics('Realidad Virtual')),
			// 			array('label' => 'Buscar Evaluación','url' => array('/RealidadVirtual/adminFicha')),
			// 			// array('label' => 'Buscar Ficha Persona','url' => array('/RealidadVirtual/admin')),
			// 			(Yii::app()->user->checkAccess('action_evaluacionAltair_admin'))?
			// 				BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Entrenador de Gases')):"",
			// 			array(
			// 				'label' => 'Buscar Evaluación',
			// 				'url' => array('/EvaluacionAltair/admin'),
			// 				'visible'=>Yii::app()->user->checkAccess('action_evaluacionAltair_admin')
			// 			),
			// 			BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Administrar Evaluación')),
			// 			array('label' => 'Tipo Evaluación','url' => array('/RealidadVirtual/adminTipo')),
			// 			array('label' => 'Crear Evaluación','url' => array('/RealidadVirtual/createEva')),
			// 			array('label' => 'Buscar Evaluación','url' => array('/RealidadVirtual/adminEva')),
			// 		)
			// 	),                
			// 	array(
			// 		'label' => 'Dispositivo',
			// 		'visible'=>Yii::app()->user->checkAccess('Adminsitrador')||Yii::app()->user->isSuperAdmin,
			// 		'items' => array(
			// 			BsHtml::menuHeader(BsHtml::italics('Dispositivos')),
			// 			array('label' => Yii::t('Navbar','Crear'),'url' => array('/Dispositivo/createDisp')),
			// 			array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Dispositivo/adminDisp')),

			// 			BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics('Tipo de dispositivo')),
			// 			array('label' => Yii::t('Navbar','Crear'),'url' => array('/Dispositivo/createTipo')),
			// 			array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Dispositivo/adminTipo')),
			// 		)
			// 	),                
			// 	array(
			// 		'label' => Yii::t('Navbar','Licencia'),
			// 		'visible'=>Yii::app()->user->checkAccess('Adminsitrador')||Yii::app()->user->isSuperAdmin,
			// 		'items' => array(
			// 			BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Licencia'))),
			// 			array('label' => Yii::t('Navbar','Crear'),'url' => array('/Licencia/createTipo')),
			// 			array('label' => 'Registros','url' => array('/Licencia/viewRecords')),
			// 			BsHtml::menuDivider().BsHtml::menuHeader(BsHtml::italics(Yii::t('Navbar','Empresa'))),
			// 			array('label' => ' Asignar','url' => array('/Licencia/create')),
			// 			array('label' => Yii::t('Navbar','Buscar'),'url' => array('/Licencia/view')),
			// 		)
			// 	),
			// )
		),
		array(
			'class' => 'bootstrap.widgets.BsNav',
			'type' => 'navbar',
			'activateParents' => true,
			// 'visible'=>Yii::app()->user->checkAccess('action_empresa_create'),
			'items' => array(
				array(
					'label'=>'Administrar Usuarios', 
					'url'=>Yii::app()->user->ui->userManagementAdminUrl, 
					'visible'=>Yii::app()->user->isSuperAdmin
				),
				array('label'=> Yii::t('Navbar','Iniciar sesión'), 'url'=>Yii::app()->user->ui->loginUrl, 'visible'=>Yii::app()->user->isGuest),
				array('label' =>Yii::t('Navbar','Cerrar sesión').' ('.Yii::app()->user->name.')','pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT,'url' => array('//site/logout'),'visible' => !Yii::app()->user->isGuest)
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