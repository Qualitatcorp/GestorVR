<?php

class LicenciaController extends Controller
{
	public $layout='columnSidebar';
	public $menu=array(
		array('label'=>'Tipo de Licencia'),
	    array('label'=>'Crear', 'url'=>array('createTipo')),
		array('label'=>'Administrar', 'url'=>array('adminTipo')),
		array('label'=>'Licencias'),
		array('label'=>'Asignar', 'url'=>array('createLic')),
		array('label'=>'Administrar', 'url'=>array('adminLic')),
		array('label'=>'Registros'),
		array('label'=>'Ver', 'url'=>array('adminDisp')),
		array('label'=>'Crear', 'url'=>array('adminDisp')),
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
	/**
		Tipo Licencia 
	**/
	public function actionCreateTipo()
	{
		$model=new LicTipo;
		if(isset($_POST['LicTipo'])){
			$model->attributes=$_POST['LicTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipo/create',array('model'=>$model));
	}
	public function actionUpdateTipo($id)
	{		
		$model=LicTipo::model()->findByPk($id);
		if(isset($_POST['LicTipo'])){
			$model->attributes=$_POST['LicTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipo/update',array('model'=>$model));
	}
	public function actionViewTipo()
	{
		$this->render('tipo/view');
	}	
	public function actionAdminTipo()
	{
		$model=LicTipo::model()->findAll();
		$this->render('tipo/admin',array('List'=>$model));
	}	
	public function actionDeleteTipo()
	{
		$this->render('tipo/view');
	}
	/**
		Licencia
	**/
	public function actionCreateLic()
	{		
		$model=new LicLicencia;
		if(isset($_POST['LicLicencia'])){
			$model->attributes=$_POST['LicLicencia'];
			if($model->save()){
				$registro=new LicRegistro;
				$registro->lic_id=$model->lic_id;
				$registro->iduser=Yii::app()->user->id;
				$registro->cantidad=$model->cantidadTotal;
				$registro->tipo='ABONO';
				$registro->descripcion='ASIGNACION DE LICENCIA';
				if($registro->save()){
					echo "guardo";
					die();
				}else
				{
					var_dump($registro->getErrors());
					echo "no se guardo";
					die();
				}
				$this->redirect(array('adminLic'));
			}

		}
		$this->render('create',array('model'=>$model));
	}
	public function actionUpdateLic($id)
	{		
		$model=LicLicencia::model()->findByPk($id);
		if(isset($_POST['LicLicencia'])){
			$model->attributes=$_POST['LicLicencia'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('update',array('model'=>$model));
	}
	public function actionViewLic()
	{
		$this->render('view');
	}
	/**
		Registro
	**/
	public function actionCreateRecords()
	{
		$this->render('record/create');
	}
	public function actionViewRecords()
	{
		$this->render('record/view');
	}
}