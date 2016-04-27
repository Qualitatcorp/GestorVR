<?php

class RealidadVirtualController extends Controller
{
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
		$this->render('adminTipo');
	}

	public function actionCreateEva()
	{
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
		$this->render('createTipo');
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

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}