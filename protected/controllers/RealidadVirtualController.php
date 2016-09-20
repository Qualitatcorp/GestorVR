<?php

class RealidadvirtualController extends Controller
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
		$this->render('tipo/create',array('model'=>$model));
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
		$this->render('tipo/edit',array('model'=>$model));
	}
	public function actionAdminTipo()
	{
		$this->layout='columnSidebar';
		$model=RvTipo::model()->findAll();
		$this->render('tipo/admin',array('List'=>$model));
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
				$this->redirect(array('RealidadVirtual/viewEva/'.$model->primarykey));
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

			//Trabajando con la imagen
			$model->imagen=CUploadedFile::getInstance($model, 'imagen');
			$valid=true;
			//Revision de Alternativas
			if(isset($_POST['RvAlternativa'])){
				foreach ($_POST['RvAlternativa'] as $value) {
					$alt=new RvAlternativa;
					$alt->attributes=$value;
					$valid=$alt->validate()&&$valid;
					$list[]=$alt;
				}
			}

			//Revision de todo y guardado
			if($valid&&$model->save()){
				//Guardar imagen
				$model->imagen->saveAs('images/rv/'.$model->pre_id.'-'.$model->imagen->name);

				//Guardar Alernativas
				foreach ($list as $value) {
					$value->pre_id=$model->pre_id;
					$value->save();
				}
				$this->redirect(array('realidadVirtual/viewEva/'.$model->eva_id));
			}else{			
				foreach ($list as $value) {
				var_dump($value->getErrors());
			}
			}
		}
		$this->render('pregunta/create',array('model'=>$model,'list'=>$list));
	}
	public function actionEditPre($id)
	{
		$this->layout='columnSidebar';
		$model=RvPregunta::model()->findByPk($id);
		$imagen=$model->imagen;
		if(isset($_POST['RvPregunta'])){
			$model->attributes=$_POST['RvPregunta'];
			$model->imagen=CUploadedFile::getInstance($model, 'imagen');
			if($model->imagen===null){
				$model->imagen=$imagen;
				$imagen=false;
			}else{
				$imagen=true;
			}
			if($model->save()){				
				//Revision de Alternativas
				$listaID=array();
				if(isset($_POST['RvAlternativa'])){
					foreach ($_POST['RvAlternativa'] as $value) {
						if(isset($value['alt_id'])){
							$alt=RvAlternativa::model()->findByPk($value['alt_id']);
						}else{
							$alt=new RvAlternativa;
						}
						$alt->attributes=$value;
						$alt->pre_id=$model->primarykey;
						$alt->save();
						$listaID[]=$alt->primarykey;
					}
				}
				//Limpia lo que no se guardo
				foreach ($model->alternativas as $value) {
					if(!in_array($value->primarykey, $listaID)){
						$value->delete();
					}
				}
				//Guardar imagen
				if($imagen)
					$model->imagen->saveAs('images/rv/'.$model->pre_id.'-'.$model->imagen->name);
				$this->redirect(array('realidadVirtual/viewEva/'.$model->eva_id));
			}
		}
		$this->render('pregunta/edit',array('model'=>$model));
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

	public function actionDeletePre($id)
	{
		$model=RvPregunta::model()->findByPk($id);
		RvAlternativa::model()->deleteAll('pre_id='.$id);
		$Evaluacion=$model->eva_id;
		$model->delete();
		$this->redirect(array('realidadVirtual/viewEva/'.$Evaluacion));
	}

	/**
		Ficha de evaluacion
	**/
	public function actionAdminFicha()
	{
		$this->render('ficha/admin');
	}

	public function actionCreateFicha()
	{
		$this->render('ficha/create');
	}
	public function actionEditFicha()
	{
		$this->render('ficha/edit');
	}
	public function actionViewFicha($id)
	{
		
        $mPDF1 = Yii::app()->ePdf->mpdf();
		// $this->render('ficha/view');
	}


}