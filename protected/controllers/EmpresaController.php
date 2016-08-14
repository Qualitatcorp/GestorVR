<?php

class EmpresaController extends Controller
{
	public $layout='//layouts/columnSidebar';
	public $menu=array(
				    array('label'=>'Crear Empresa', 'url'=>array('create')),
				    array('label'=>'Administar Empresa', 'url'=>array('admin')),
				);
	public function filters()
	{
		return array(array('CrugeAccessControlFilter'));
	}
	
	public function accessRules()
	{
		Yii::app()->user->loginUrl = array("/pwh/agent/login");
		return array(
			array('accessControl'),			
		);
	}
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCreate()
	{
		$model=new Empresa;
		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->emp_id));
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->emp_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Empresa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionAdmin()
	{
		$model=new Empresa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Empresa']))
			$model->attributes=$_GET['Empresa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function loadModel($id)
	{
		$model=Empresa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/*
		Crear Usuario

	*/

	public function actionCreateUsu($id)
	{
		$model=new Usuario;
		if(isset($_POST['Usuario'])){
			$model->attributes=$_POST['Usuario'];
			if($model->save());
		}
		$this->render('usuario/create',array('model'=>$model));
	}
}