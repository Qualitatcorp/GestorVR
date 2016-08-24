<?php

class LicenciaController extends Controller
{
	public $layout='columnSidebar';
	public $menu=array(
		array('label'=>'Tipo de Licencia'),
	    array('label'=>'Crear', 'url'=>array('createTipo')),
		array('label'=>'Administrar', 'url'=>array('adminTipo')),
		array('label'=>'Licencias'),
		array('label'=>'Asignar', 'url'=>array('create')),
		array('label'=>'Administrar', 'url'=>array('admin')),
		array('label'=>'Registros'),
		array('label'=>'Ver', 'url'=>array('adminRecords')),
		array('label'=>'Crear', 'url'=>array('viewRecords')),
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
		$model=new LicenciaTipo;
		if(isset($_POST['LicenciaTipo'])){
			$model->attributes=$_POST['LicenciaTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipo/create',array('model'=>$model));
	}
	public function actionUpdateTipo($id)
	{		
		$model=LicenciaTipo::model()->findByPk($id);
		if(isset($_POST['LicenciaTipo'])){
			$model->attributes=$_POST['LicenciaTipo'];
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
		$model=LicenciaTipo::model()->findAll();
		$this->render('tipo/admin',array('List'=>$model));
	}	
	public function actionDeleteTipo()
	{
		$this->render('tipo/view');
	}
	/**
		Licencia
	**/
	public function actionCreate()
	{		
		$model=new Licencia;
		if(isset($_POST['Licencia'])){
			$model->attributes=$_POST['Licencia'];
			if($model->save()){
				$registro=new LicenciaRegistro;
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
				$this->redirect(array('admin'));
			}
		}
		$this->render('create',array('model'=>$model));
	}
	public function actionUpdate($id)
	{		
		$model=Licencia::model()->findByPk($id);
		if(isset($_POST['Licencia'])){
			$model->attributes=$_POST['Licencia'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('update',array('model'=>$model));
	}
	public function actionView()
	{
		$this->render('view');
	}	
	public function actionDelete($id)
	{		
			Licencia::model()->findByPk($id)->delete();
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