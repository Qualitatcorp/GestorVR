<?php

class SyncController extends Controller
{
	public function actionIndex()
	{
		var_dump(Trabajador::findByMetodo("Ruben,Tejeda,Roa","NOMBRE_TRABAJADOR"));
	}	
	public function actionEvaluacion()
	{
				// http_response_code(418);
				// var_dump($_POST);
				// die();
		if(isset($_POST['Respuesta'])&&isset($_POST['keycode'])&&isset($_POST['trabajador'])){
			$valid=true;
			$lista=array();
			foreach ($_POST['Respuesta'] as $value) {
				$model=new RvRespuesta;
				$RvA=RvAlternativa::model()->findByPregunta($value['Pregunta'],$value['Alternativa']);
				if(empty($RvA)){
					http_response_code(500);
					echo "Faltan pregunta por definir :";
					var_dump($value['Pregunta'],$value['Alternativa']);
					die("FIN");
				}
				$model->alt_id=$RvA->primaryKey;
				$model->creado=$value['Creacion'];
				$valid=$model->validate()&&$valid;
				$lista[]=$model;
			}
			$model=new RvFicha;
			/*
			 *		Pone pais si existe
			 */
			$pais=46;
			if(isset($_POST['pais'])){
				$p=Pais::findByCodigo($_POST['pais']);
				if(!empty($p)){
					$pais=$p->primaryKey;
				}else{
					http_response_code(500);
					echo "No existe el codigo del pais : ".$_POST['pais'];
					die();
				}
			}
			$model->pais_id=$pais;
			$model->eva_id=RvAlternativa::model()->findByPk($lista[0]->alt_id)->pregunta->eva_id;
			if(isset($_POST['proyecto'])){
				$model->pro_id=RvProyecto::findByNombre($_POST['proyecto'])->primaryKey;
			}
			/*
			 *		Identificacion mediante metodo trabajador
			 */
			$metodo_trabajador="RUT_TRABAJADOR";
			if(isset($_POST['metodoTrabajador'])){
				$metodo_trabajador=$_POST['metodoTrabajador'];
			}
			$trabajador=Trabajador::findByMetodo($_POST['trabajador'],$metodo_trabajador);
			if(empty($trabajador)){
				echo "El trabajador no existe\n";
				var_dump($_POST);
				http_response_code(500);
				die();
			}else{
				$model->trab_id=$trabajador->primaryKey;
			}
			/*
			 *		Identificacion mediante metodo empresa
			 */
			$metodo="RUT_EMPRESA";
			if(isset($_POST['metodo'])){
				$metodo=$_POST['metodo'];
			}
			$empresa=Empresa::findByMetodo($_POST['empresa'],$metodo);
			/*
			 *		Identificacion dispositivo
			 */
			$model->disp_id=Dispositivo::model()->findByKeycode($_POST['keycode'],$empresa)->primaryKey;

			/*
			 * 		Validacion Evaluacion
			 */
			if($valid&&$model->save()){
				foreach ($lista as $value) {
					$value->fic_id=$model->primaryKey;
					$value->save();
				}
				echo $model->primaryKey;
			}else{
				var_dump($model->getErrors());
				foreach ($lista as $value) {
					var_dump($value->getErrors());
				}
			}
		}
		else{
				http_response_code(500);
				echo "No existe informacion";
		}
	}

	public function actionDispositivo()
	{
		if(!empty($_POST)){
			$metodo="RUT_EMPRESA";
			if(isset($_POST['metodo'])){
				$metodo=$_POST['metodo'];
			}
			$empresa=Empresa::findByMetodo($_POST['empresa'],$metodo);
			$model=Dispositivo::model()->findByKeycode($_POST['keycode'],$empresa);
			if(!empty($model)){
				echo ($model->activado=='SI'&&$model->habilitado=='SI')?'true':'false';
				// if($model->serial!=''){
				// 	if($model->serial==$_POST['serial']){
				// 		$model->habilitado='SI';
				// 	}else{
				// 		$model->habilitado='NO';
				// 	}
				// }
				// if($model->save()){
				// 	echo (($model->habilitado=='SI')&&($model->activado=='SI'))?'true':'false';
				// }
			}else{
				echo "false";
			}
		}else{
			throw new CHttpException(511,'No tienes acceso');
		}
	}
}