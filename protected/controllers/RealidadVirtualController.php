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

	public function filters(){return array(array('CrugeAccessControlFilter'));}
	public function accessRules(){return array(array('accessControl'));}
	
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
		//Agrega Elemento al Menu
		array_push($this->menu,
			array('label'=>'Pregunta'),
			array('label'=>'Crear', 'url'=>array('createPre','id'=>$model->eva_id))
		);

		$this->render('evaluacion/view',array('model'=>$model));
	}
	public function actionDeleteEva($id)
	{
		RvEvaluacion::model()->deleteByPk($id);
		$this->redirect(array('adminEva'));
	}
	/**
		Preguntas de Evaluacion
	**/
	public function actionCreatePre($id)
	{
		$this->layout='columnSidebar';
		$model=new RvPregunta;
		$list=array();
		$model->eva_id=$id;
		if(isset($_POST['RvPregunta'])){
			$model->attributes=$_POST['RvPregunta'];
			$valid=true;
			if(isset($_POST['RvAlternativa'])){
				foreach ($_POST['RvAlternativa'] as $value) {
					$alt=new RvAlternativa;
					$alt->attributes=$value;
					$valid=$alt->validate()&&$valid;
					$list[]=$alt;
				}
			}
			if($valid&&$model->save()){
				foreach ($list as $value) {
					$value->pre_id=$model->pre_id;
					$value->save();
				}
				$this->redirect(array('realidadVirtual/viewEva/'.$model->eva_id));
			}
		}
		$this->render('pregunta/create',array('model'=>$model,'list'=>$list));
	}

	public function actionAdminPre($id)
	{
		$this->layout='columnSidebar';
		$model=RvPregunta::model()->findAll('eva_id='.$id);
		if(isset($_POST['RvPregunta'])){
			$model->attributes=$_POST['RvPregunta'];
			$valid=true;
			if(isset($_POST['RvAlternativa'])){
				foreach ($_POST['RvAlternativa'] as $value) {
					$alt=new RvAlternativa;
					$alt->attributes=$value;
					$valid=$alt->validate()&&$valid;
					$list[]=$alt;
				}
			}
			if($valid&&$model->save()){
				foreach ($list as $value) {
					$value->pre_id=$model->pre_id;
					$value->save();
				}
				$this->redirect(array('realidadVirtual/viewEva/'.$model->eva_id));
			}
		}
		$this->render('pregunta/admin',array('List'=>$model));
	}
	public function actionEditPre($id)
	{
		$this->layout='columnSidebar';
		$model=RvPregunta::model()->findByPk($id);
		$list=$model->Alternativas;		
		if(isset($_POST['RvPregunta'])){
			$model->attributes=$_POST['RvPregunta'];
			$valid=true;
			if(isset($_POST['RvAlternativa'])){
				foreach ($_POST['RvAlternativa'] as $key=>$value) {
					if(!isset($list[$key])){
						$list[$key]=new RvAlternativa;
						$list[$key]->pre_id=$model->pre_id;
					}
					$list[$key]->attributes=$value;
					$valid=$list[$key]->validate()&&$valid;
					var_dump($list[$key]->getErrors());
				}
			}
			var_dump($valid);
			if($valid&&$model->save()){
				foreach ($list as $key=>$value) {
					if(array_key_exists($key,$_POST['RvAlternativa'])){
						$value->save();			
					}else{
						$value->delete();
					}
				}
				// $this->redirect(array('realidadVirtual/viewEva/'.$model->eva_id));
			}
		}
		$this->render('pregunta/edit',array('model'=>$model,'list'=>$list));
	}

	public function actionDeletePre($id)
	{
		$model=RvPregunta::model()->findByPk($id);
		if($model!==null){
			RvAlternativa::model()->deleteAll('eva_id='.$id);
			$id=$model->eva_id;
			if($model->delete()){
				echo "Se elimino";
			}else{
				echo "No se elimino";
			}
		// $this->redirect(array('realidadVirtual/viewEva/'.$id));
		}
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


}