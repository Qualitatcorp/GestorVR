<?php

class TrabajadorController extends Controller
{
	public $layout='//layouts/columnSidebar';
	function init(){
		if(isset(Yii::app()->session['lang']))
			Yii::app()->setLanguage(Yii::app()->session['lang']);
		else{
			Yii::app()->setLanguage('es');
			Yii::app()->session['lang']='es';
		}
		parent::init();
	}
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
			else{
				if(!empty($model->getError("rut"))){
					if(!empty($tra=$model->findByRUT($model->rut))){
						$this->redirect(array('update','id'=>$tra->tra_id));
					}
				}
			}
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
		if(Yii::app()->user->checkAccess('Supervisor')&&!Yii::app()->user->isSuperAdmin){
			$model=Trabajador::model()->findAllByEmpresaUsuario(Yii::app()->user->id);
			$e=new Excel;
			$e->addModel('Trabajadores',array('rut','nombre','paterno','materno','nacimiento','fono','mail','gerencia','cargo','antiguedad','estado_civil','hijos'),$model);
			$e->out('trabajadores',true);
		}else{
			if(Yii::app()->user->checkAccess('Cliente')&&!Yii::app()->user->isSuperAdmin) {
				$id=EmpresaUsuario::findByID(Yii::app()->user->id)->emp_id;
				$model=Trabajador::model()->findAllByEmpresa($id);
				$e=new Excel;
				$e->addModel('Trabajadores',array('rut','nombre','paterno','materno','nacimiento','fono','mail','gerencia','cargo','antiguedad','estado_civil','hijos'),$model);
				$e->out('trabajadores',true);
			}else{	
				if(Yii::app()->user->checkAccess('Administrador')||Yii::app()->user->isSuperAdmin) {
					$model=Trabajador::model()->findAll();
					$e=new Excel;
					$e->addModel('Trabajadores',array('rut','nombre','paterno','materno','nacimiento','fono','mail','gerencia','cargo','antiguedad','estado_civil','hijos'),$model);
					$e->out('trabajadores',true);
				}
			}
		}
		echo "Sin acceso";
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
				// die();
				$act=0;
				unset($trabajadores[0]);
				foreach ($trabajadores as $value) {
					if(($rut=Trabajador::checkRut($value[0]))!==null){
						if(strlen($rut)<11||strlen($rut)>12){
						Yii::app()->user->setFlash('error', "El rut $rut no tiene el largo correcto.");
						}else{
							$t=Trabajador::findByRUT($rut);
							if(!empty($value[1])){
								$t->nombre=$value[1];
							}
							if(!empty($value[2])){
								$t->paterno=$value[2];
							}
							if(!empty($value[3])){
								$t->materno=$value[3];
							}
							if(!empty($value[4])){
								if(is_string($value[4])){
									$t->nacimiento=date("Y-m-d",strtotime($value[4]));
								}else{
									$t->nacimiento=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($value[4]));
								}
							}
							if(!empty($value[5])){
								$t->fono=$value[5];
							}
							if(!empty($value[6])){
								$t->mail=$value[6];
							}
							if(!empty($value[7])){
								$t->gerencia=$value[7];
							}
							if(!empty($value[8])){
								$t->cargo=$value[8];
							}
							if(!empty($value[9])){
								$t->antiguedad=$value[9];
							}
							if(!empty($value[10])){
								$t->estado_civil=$value[10];
							}
							if(!empty($value[11])){
								$t->hijos=$value[11];
							}
							if($t->save()){
								$act++;
							}else{
								// var_dump($t,$t->getErrors());
								Yii::app()->user->setFlash('error', "El rut $value[0] es invalido o no tiene un formato correcto.");
							}
						}
					}else{
						Yii::app()->user->setFlash('error', "El rut $value[0] es invalido o no tiene un formato correcto.");
					}

					Yii::app()->user->setFlash('info', "Se han actualizado {$act} trabajadores");
				}
			};
		}
		$this->render('excel/load',array('model'=>$model));
	}
}