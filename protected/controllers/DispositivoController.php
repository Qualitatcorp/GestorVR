<?php

class DispositivoController extends Controller
{
	public function actionAdminDisp()
	{
		$this->render('adminDisp');
	}

	public function actionAdminTipo()
	{
		$this->render('adminTipo');
	}

	public function actionCreateDisp()
	{
		$this->render('createDisp');
	}

	public function actionCreateTipo()
	{
		$this->render('createTipo');
	}

	public function actionEditDisp()
	{
		$this->render('editDisp');
	}

	public function actionEditTipo()
	{
		$this->render('editTipo');
	}

	public function actionViewDisp()
	{
		$this->render('viewDisp');
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