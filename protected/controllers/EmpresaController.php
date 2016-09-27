<?php

class EmpresaController extends Controller
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
		Yii::app()->user->loginUrl = array("/pwh/agent/login");
		return array(
			array('accessControl'),			
		);
	}

	/*
		Empresa
	*/
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
				$this->redirect(array('view','id'=>$model->primaryKey));
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
				$this->redirect(array('view','id'=>$model->primaryKey));
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
		if(EmpresaUsuario::findByUsuario());

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
		Usuarios
	*/

	public function actionCreateUsu($id)
	{
		$model=new EmpresaUsuario;
		$model->emp_id=$id;
		if(!Yii::app()->user->checkAccess('Administador'))
			$model->role='Supervisor';
		if(isset($_POST['EmpresaUsuario'])){
			$model->attributes=$_POST['EmpresaUsuario'];
			$model->disp=$_POST['EmpresaUsuario']['disp'];
			if($model->validate()){
				$usuario = Yii::app()->user->um->createNewUser(array(
					'username'=>$model->rut,
					'email'=>$model->email,
				));
				Yii::app()->user->um->activateAccount($usuario);
				if($model->password!='')
					Yii::app()->user->um->changePassword($usuario,$model->password);
				if(Yii::app()->user->um->save($usuario)){
					$auth=Yii::app()->authManager;
					$auth->assign($model->role,$usuario->primaryKey);
					$model->usu_id=$usuario->primaryKey;
					$model->scenario='save';
					if($model->save()){
						$model->setDisp();
						$this->redirect(array('view','id'=>$model->emp_id));
					}else{
						var_dump($model->getErrors());
					}
				}else{           
					$errores = CHtml::errorSummary($usuario);
          			echo "no se pudo crear el usuario: ".$errores;
				}

			}
		}
		$this->render('usuario/create',array('model'=>$model));
	}

	public function actionUpdateUsu($id)
	{
		$model=EmpresaUsuario::model()->findByPk($id);
		$model->getDisp();
		if(isset($_POST['EmpresaUsuario'])){
			$model->attributes=$_POST['EmpresaUsuario'];
			$model->clasificacion=$_POST['EmpresaUsuario']['clasificacion'];
			if (isset($_POST['EmpresaUsuario']['disp'])) {
				$model->disp=$_POST['EmpresaUsuario']['disp'];
			}
			
			if($model->password!='')
				Yii::app()->user->um->changePassword($model->usu_id,$model->password);
			$model->Scenario='save';
			if($model->save()){			
				if (isset($_POST['EmpresaUsuario']['disp'])) {
					$model->setDisp();
				}
				$this->redirect(array('view','id'=>$model->emp_id));
			}
		}
		$this->render('usuario/update',array('model'=>$model));
	}
	public function actionUsu($id)
	{
        $model = EmpresaUsuario::model()->findByPk($id);
		$this->render('usuario/view',array('model'=>$model));
	}
	public function actionAdminFichaUsu($id)
	{
		$user=EmpresaUsuario::model()->findByPk($id);
		$find=new RvFichaForm;
		$find->usuario=$user->primaryKey;
		$find->inicio=date("Y-m-d",strtotime(date("Y-m-d").' - 15 days'));
		$find->termino=date("Y-m-d");
		$find->termino=date("Y-m-d");
		$find->order='t.creado desc';
		$find->limite=100;
		if(isset($_POST['RvFichaForm'])){
			// var_dump($_POST);
			$find->attributes=$_POST['RvFichaForm'];
			$find->activo=true;
			$find->validate();
		}
		$model=RvFicha::model()->findAll($find->fichas);
		$this->render('ficha/admin',array(
			'model'=>$model,
			'urlReturn'=>Yii::app()->createUrl("empresa/usu/$id"),
			'find'=>$find,
			));
	}
	public function actionDeleteUsu($id)
	{
		
        $model = EmpresaUsuario::model()->findByPk($id);
        // $model->scenario = 'delete';
        if($model->usu->delete()){
        	$this->redirect(array($model->emp_id));
        }else{
        	echo "Error eliminado.";
        }
	}
	/*
		Dipositivos
	*/

	public function actionCreateDisp($id)
	{
		$model=new Dispositivo;
		if(isset($_POST['Dispositivo'])){
			$model->attributes=$_POST['Dispositivo'];
			$model->emp_id=$id;
			if($model->save())
				$this->redirect(array('view','id'=>$id));
		}
		$this->render('dispositivo/create',array('model'=>$model));
	}
	public function actionEditDisp($id)
	{	
		$model=Dispositivo::model()->findByPk($id);
		if(isset($_POST['Dispositivo'])){
			$model->attributes=$_POST['Dispositivo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->emp_id));
		}
		$this->render('dispositivo/update',array('model'=>$model));
	}
	public function actionDeleteDisp($id)
	{
		$model=Dispositivo::model()->findByPk($id);
		if($model->delete()){
        	$this->redirect(array($model->emp_id));
		}else{
			echo 'Error al eliminar';
		}
	}

	/*
		Licencia
	*/

	public function actionCreateLic($id)
	{
		$model=new Licencia;
		if(isset($_POST['Licencia'])){
			$model->attributes=$_POST['Licencia'];
			$model->emp_id=$id;
			if($model->save()){
				$registro=new LicenciaRegistro;
				$registro->lic_id=$model->lic_id;
				$registro->iduser=Yii::app()->user->id;
				$registro->cantidad=$model->cantidadTotal;
				$registro->tipo='ABONO';
				$registro->descripcion='ASIGNACION DE LICENCIA';
				if($registro->save()){
				$this->redirect(array('view','id'=>$model->emp_id));
				}else
				{
					var_dump($registro->getErrors());
					echo "no se guardo";
					die();
				}
			}
		}
		$this->render('licencia/create',array('model'=>$model));
	}
	public function actionEditLic($id)
	{	
		$model=Licencia::model()->findByPk($id);
		$model->creado=date_format(date_create($model->creado), 'Y-m-d');
		if(isset($_POST['Licencia'])){
			$model->attributes=$_POST['Licencia'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->emp_id));
		}
		$this->render('licencia/update',array('model'=>$model));
	}
	public function actionDeleteLic($id)
	{
		$model=Licencia::model()->findByPk($id);
		if($model->delete()){
        	$this->redirect(array($model->emp_id));
		}else{
			echo 'Error al eliminar';
		}
	}

	/*
		Ficha
	*/

	public function actionAdminFicha($id=null)
	{
		if(empty($id)){
			if(Yii::app()->user->checkAccess('Cliente')){
				$this->redirect(array('adminFicha','id'=>EmpresaUsuario::findByID()->emp->primaryKey));
			}
		}else{
			if(Yii::app()->user->checkAccess('Cliente')){
				if($id!=EmpresaUsuario::findByID()->emp->primaryKey){
					$this->redirect(array('adminFicha','id'=>EmpresaUsuario::findByID()->emp->primaryKey));
				}
			}
		}
		$find=new RvFichaForm;
		$find->empresa=$id;
		$find->inicio=date("Y-m-d",strtotime(date("Y-m-d").' - 15 days'));
		$find->termino=date("Y-m-d");
		$find->termino=date("Y-m-d");
		$find->order='t.creado desc';
		$find->limite=100;
		if(isset($_POST['RvFichaForm'])){
			$find->attributes=$_POST['RvFichaForm'];
			$find->activo=true;
			if($find->validate()){
				if(isset($_POST['excel'])){
					$find->excel;
				}
			}
		}
		$model=RvFicha::model()->findAll($find->fichas);
		$this->render('ficha/admin',array(
			'model'=>$model,
			'nombre'=>Empresa::model()->findByPk($id)->nombre,
			'urlReturn'=>Yii::app()->createUrl("empresa/$id"),
			'find'=>$find,
			));
	}
	public function actionViewFichaPDF($id)
	{
		$model = RvFicha::model()->findByPk($id);
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1->WriteHTML($this->renderPartial('ficha/viewPDF',array('model'=>$model),true));
        $mPDF1->Output("{$model->creado} {$model->trabajador->rut} f{$model->fic_id}.pdf",'I');
        exit();
        $this->renderPartial('ficha/viewPDF',array('model'=>$model));
	}
	public function actionViewFicha($id)
	{
		
		$model = RvFicha::model()->findByPk($id);
        $this->render('ficha/view',array('model'=>$model));
	}
	/*
		Evaluacion
	*/
	public function actionEvaluacion($id=null)
	{
		if(empty($id)){
			if(Yii::app()->user->checkAccess('Cliente')){
				$this->redirect(array('evaluacion','id'=>EmpresaUsuario::findByID()->emp->primaryKey));
			}
		}else{
			if(Yii::app()->user->checkAccess('Cliente')){
				if($id!=EmpresaUsuario::findByID()->emp->primaryKey){
					$this->redirect(array('evaluacion','id'=>EmpresaUsuario::findByID()->emp->primaryKey));
				}
			}
		}
		$model=Empresa::model()->findByPk($id);
		$this->render('evaluacion/view',array('model'=>$model));

	}
	// public function action($id)
	// {

	// }

	/*
		Trabajador
	*/
	public function actionTrabajador()
	{
		$id=EmpresaUsuario::model()->findByID()->emp->primaryKey;
		$model = new Trabajador;
		if (isset($_POST['Trabajador'])) {
			$model=Trabajador::model()->findByRUT($_POST['Trabajador']['rut']);
		}
		$this->render('trabajador/find',array('model'=>$model,'empresa'=>$id));
	}
	public function actionTrabajadorUpdate($id)
	{
		$model=Trabajador::model()->findByPk($id);
		if(isset($_POST['Trabajador']))
		{
			$model->attributes=$_POST['Trabajador'];
			if($model->save())
				$this->redirect(array('Trabajador'));
		}
		$this->render('trabajador/update',array(
			'model'=>$model,
		));
	}
}