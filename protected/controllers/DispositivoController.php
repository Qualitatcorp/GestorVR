<?php

class DispositivoController extends Controller
{
	public $layout='columnSidebar';
	public $menu=array(
		array('label'=>'Tipo de Dispositivo'),
	    array('label'=>'Crear', 'url'=>array('createTipo')),
		array('label'=>'Administrar', 'url'=>array('adminTipo')),
		array('label'=>'Dispositivo'),
		array('label'=>'Crear', 'url'=>array('createDisp')),
		array('label'=>'Administrar', 'url'=>array('adminDisp')),
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
	//Tipo de Dispositivo
	public function actionAdminTipo()
	{
		$model=DispositivoTipo::model()->findAll();
		$this->render('tipo/admin',array('List'=>$model));
	}
	public function actionCreateTipo()
	{
		$model=new DispositivoTipo;
		if(isset($_POST['DispositivoTipo'])){
			$model->attributes=$_POST['DispositivoTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipo/create',array('model'=>$model));
	}

	public function actionEditTipo($id)
	{
		$model=DispositivoTipo::model()->findByPk($id);
		if(isset($_POST['DispositivoTipo'])){
			$model->attributes=$_POST['DispositivoTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipo/edit',array('model'=>$model));
	}
	public function actionViewTipo()
	{
		$this->render('tipo/view');
	}

	public function actionDeleteTipo($id)
	{
		DispositivoTipo::model()->deleteByPk($id);
		$this->redirect(array('adminTipo'));
	}
	//Dispositivo
	public function actionAdminDisp()
	{
		$model=Dispositivo::model()->findAll();
		$this->render('admin',array('List'=>$model));
	}
	public function actionCreateDisp()
	{		
		$model=new Dispositivo;
		if(isset($_POST['Dispositivo'])){
			$model->attributes=$_POST['Dispositivo'];
			if($model->save())
				$this->redirect(array('adminDisp'));
		}
		$this->render('create',array('model'=>$model));
	}
	public function actionEditDisp($id)
	{	
		$model=Dispositivo::model()->findByPk($id);
		if(isset($_POST['Dispositivo'])){
			$model->attributes=$_POST['Dispositivo'];
			if($model->save())
				$this->redirect(array('adminDisp'));
		}
		$this->render('edit',array('model'=>$model));
	}
	public function actionViewDisp()
	{
		$this->render('view');
	}

}