<?php

class DispositivoController extends Controller
{
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
}