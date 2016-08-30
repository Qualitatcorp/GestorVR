<?php

class TrabajadorController extends Controller
{
	public $layout='//layouts/columnSidebar';

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
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCreate()
	{
		$model=new Trabajador;

		if(isset($_POST['Trabajador']))
		{
			$model->attributes=$_POST['Trabajador'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->tra_id));
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Trabajador']))
		{
			$model->attributes=$_POST['Trabajador'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->tra_id));
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
		$dataProvider=new CActiveDataProvider('Trabajador');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionAdmin()
	{
		$model=new Trabajador('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trabajador']))
			$model->attributes=$_GET['Trabajador'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function loadModel($id)
	{
		$model=Trabajador::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trabajador-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionDownExcel()
	{
		$e=new Excel;
		$model=Trabajador::model()->findAll();
		$e->addModel('Trabajadores',
			array('rut','nombre','paterno','materno'/*,'nacimiento','fono','mail'*/),$model);
		$e->out('prueba',true);
	}
	public function actionLoadExcel()
	{
// 		Yii::app()->user->setFlash('success', "Data1 saved!");
// Yii::app()->user->setFlash('error', "Data2 failed!");
// Yii::app()->user->setFlash('info', "Data3 ignored.");
		$model=new Excel;
		if(isset($_POST['Excel'])){
			$model->file=CUploadedFile::getInstance($model, 'file');
			if($model->validate()){
				$trabajadores=$model->load($model->file->getTempName());
				// var_dump($trabajadores);
				$valid=true;
				$act=0;
				unset($trabajadores[0]);
				foreach ($trabajadores as $value) {
					if($rut=Trabajador::checkRut($value[0])!==null){
						$t=Trabajador::findByRUT($rut);

						if($value[1]){
							$t->nombre=$value[1];
						}
						if($value[2]){
							$t->paterno=$value[2];
						}
						if($value[3]){
							$t->materno=$value[3];
						}
						if($t->save()){
							$act++;
						}
					}else{
						Yii::app()->user->setFlash('error', "El rut $value[0] es invalido o no tiene un formato correcto.");
					}
					Yii::app()->user->setFlash('info', "Se han actualizado {$act} trabajadores");
				}
				// var_dump($model->file);
				// $model->file->saveAs('file/excel/'.$model->file->name);				
				// var_dump($model->load('file/excel/'.$model->file->name));

			};
		}
		$this->render('excel/load',array('model'=>$model));
	}
}