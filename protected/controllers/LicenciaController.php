<?php

class LicenciaController extends Controller
{
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