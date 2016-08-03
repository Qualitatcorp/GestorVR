<?php

class LicenciaController extends Controller
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
	public function actionCreateLic()
	{
		$this->render('createLic');
	}

	public function actionCreateRecords()
	{
		$this->render('createRecords');
	}

	public function actionCreateTipo()
	{
		$this->render('createTipo');
	}

	public function actionEditLic()
	{
		$this->render('editLic');
	}

	public function actionEditTipo()
	{
		$this->render('editTipo');
	}

	public function actionViewLic()
	{
		$this->render('viewLic');
	}

	public function actionViewRecords()
	{
		$this->render('viewRecords');
	}

	public function actionViewTipo()
	{
		$this->render('viewTipo');
	}
}