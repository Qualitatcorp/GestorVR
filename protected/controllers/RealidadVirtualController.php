<?php

class RealidadVirtualController extends Controller
{
	public $layout='//layouts/column2';
	public $menu=array(
		array('label'=>'Tipo de Evaluación'),
	    array('label'=>'Crear', 'url'=>array('createTipo')),
		array('label'=>'Administrar', 'url'=>array('adminTipo')),
		array('label'=>'Evaluación'),
		array('label'=>'Crear', 'url'=>array('createEva')),
		array('label'=>'Administrar', 'url'=>array('adminEva')),
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
		Tipo de Evaluacion
	**/
	public function actionCreateTipo()
	{
		$model=new RvTipo;
		$this->layout='columnSidebar';

		if(isset($_POST['RvTipo'])){
			$model->attributes=$_POST['RvTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipoevaluacion/create',array('model'=>$model));
	}
	public function actionEditTipo($id)
	{
		$model=RvTipo::model()->findByPk($id);
		$this->layout='columnSidebar';
		if(isset($_POST['RvTipo'])){
			$model->attributes=$_POST['RvTipo'];
			if($model->save())
				$this->redirect(array('adminTipo'));
		}
		$this->render('tipoevaluacion/edit',array('model'=>$model));
	}
	public function actionAdminTipo()
	{
		$this->layout='columnSidebar';
		$model=RvTipo::model()->findAll();
		$this->render('tipoevaluacion/admin',array('List'=>$model));
	}

	public function actionDeleteTipo($id)
	{
		RvTipo::model()->deleteByPk($id);
		$this->redirect(array('adminTipo'));
	}

	/**
		Evaluacion
	**/
	public function actionCreateEva()
	{
		$model=new RvEvaluacion;
		$this->layout='columnSidebar';
		if(isset($_POST['RvEvaluacion'])){
			$model->attributes=$_POST['RvEvaluacion'];
			if($model->save())
				$this->redirect(array('adminEva'));
		}
		$this->render('evaluacion/create',array('model'=>$model));
	}
	public function actionEditEva($id)
	{
		$model=RvEvaluacion::model()->findByPk($id);
		$this->layout='columnSidebar';
		if(isset($_POST['RvEvaluacion'])){
			$model->attributes=$_POST['RvEvaluacion'];
			if($model->save())
				$this->redirect(array('adminEva'));
		}
		$this->render('evaluacion/edit',array('model'=>$model));
	}
	public function actionAdminEva()
	{
		$this->layout='columnSidebar';
		$model=RvEvaluacion::model()->findAll();
		$this->render('evaluacion/admin',array('List'=>$model));
	}

	public function actionViewEva($id)
	{
		$this->layout='columnSidebar';
		$model=RvEvaluacion::model()->findByPk($id);
		$this->render('evaluacion/view',array('model'=>$model));
	}
	public function actionDeleteEva($id)
	{
		RvEvaluacion::model()->deleteByPk($id);
		$this->redirect(array('adminEva'));
	}

	/**
		Ficha de evaluacion
	**/
	public function actionAdminFicha()
	{
		$this->render('adminFicha');
	}

	public function actionCreateFicha()
	{
		$this->render('createFicha');
	}
	public function actionEditFicha()
	{
		$this->render('editFicha');
	}
	public function actionViewFicha()
	{
		$this->render('viewFicha');
	}

	/**
		Preguntas de Evaluacion
	**/
	public function actionCreatePre($id)
	{
		$this->render('pregunta/create');
	}


	public function actionEditPre()
	{
		$this->render('editPre');
	}

	public function actionViewPregunta()
	{
		$this->render('viewPregunta');
	}

}