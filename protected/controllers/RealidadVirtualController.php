<?php

class RealidadVirtualController extends Controller
{
	public $layout='//layouts/column2';
	public $menu=array(
		array('label'=>'Tipo de Evaluación'),
	    array('label'=>'Crear', 'url'=>array('createTipo')),
		array('label'=>'Administrar', 'url'=>array('adminTipo')),
		array('label'=>'Evaluación'),
		array('label'=>'Crear', 'url'=>array('createEva')),
		array('label'=>'Administrar', 'url'=>array('adminEva')),
		);

	public function filters()
	{
		return array(array('CrugeAccessControlFilter'));
	}

	public function accessRules()
	{
		return array(
			array('accessControl'),
		);
	}
	
	public function actionAdminEva()
	{
		$this->render('adminEva');
	}

	public function actionAdminFicha()
	{
		$this->render('adminFicha');
	}

	public function actionAdminTipo()
	{
		$this->layout='columnSidebar';
		$model=RvTipo::model()->findAll();
		$this->render('tipoevaluacion/admin',array('model'=>$model));
	}

	public function actionCreateEva()
	{
		$this->layout='columnSidebar';
		$this->render('createEva');
	}

	public function actionCreateFicha()
	{
		$this->render('createFicha');
	}

	public function actionCreatePre()
	{
		$this->render('createPre');
	}

	public function actionCreateTipo()
	{
		$model=new RvTipo;
		$this->layout='columnSidebar';
		$this->render('tipoevaluacion/create',array('model'=>$model));
	}

	public function actionEditEva()
	{
		$this->render('editEva');
	}

	public function actionEditFicha()
	{
		$this->render('editFicha');
	}

	public function actionEditPre()
	{
		$this->render('editPre');
	}

	public function actionEditTipo()
	{
		$this->render('editTipo');
	}

	public function actionViewEva()
	{
		$this->render('viewEva');
	}

	public function actionViewFicha()
	{
		$this->render('viewFicha');
	}

	public function actionViewPregunta()
	{
		$this->render('viewPregunta');
	}

	public function actionViewTipo()
	{
		$this->render('viewTipo');
	}
}