<?php

class UsuarioController extends Controller
{

	public $layout='//layouts/column2';

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

	/**
			Usuario
	*/

	public function actionView($id)
	{
	}

	public function actionCreate()
	{
		$model=new Usuario;
		if(isset($_POST['Usuario'])){
			$model->attributes=$_POST['Usuario'];
			if($model->save());
		}
		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate()
	{
	}

	public function actionDeleted()
	{
	}

	public function actionAdmin()
	{		
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}