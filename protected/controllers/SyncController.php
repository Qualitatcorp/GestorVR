<?php

class SyncController extends Controller
{
	public function actionIndex()
	{

	}	
	public function actionEvaluacion()
	{
		if(isset($_POST['Respuesta'])&&isset($_POST['keycode'])&&isset($_POST['trabajador'])){
			$valid=true;
			$lista=array();
			foreach ($_POST['Respuesta'] as $value) {
				$model=new RvRespuesta;
				// $model->alt_id=RvAlternativa::model()->findByPregunta($value['Pregunta'],$value['Alternativa'])->primaryKey;
				$RvA=RvAlternativa::model()->findByPregunta($value['Pregunta'],$value['Alternativa']);
				if(empty($RvA)){
					echo "Faltan pregunta por definir :";
					var_dump($value['Pregunta'],$value['Alternativa']);
					die("FIN");
					// throw new CHttpException(500,'Falta Preguntas');
				}
				$model->alt_id=$RvA->primaryKey;
				$model->creado=$value['Creacion'];
				$valid=$model->validate()&&$valid;
				$lista[]=$model;
			}
			$model=new RvFicha;
			$model->eva_id=RvAlternativa::model()->findByPk($lista[0]->alt_id)->pregunta->eva_id;
			if(isset($_POST['proyecto'])){
				$model->pro_id=RvProyecto::findByNombre($_POST['proyecto'])->primaryKey;
			}
			$model->trab_id=Trabajador::model()->findByRUT($_POST['trabajador'])->primaryKey;
			$model->disp_id=Dispositivo::model()->findByKeycode($_POST['keycode'],$_POST['empresa'])->primaryKey;
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
			echo "Chupala";
			// throw new CHttpException(511,'No tienes acceso');
		}
	}

	public function actionDispositivo()
	{
		if(!empty($_POST)){
			$model=Dispositivo::model()->findByKeycode($_POST['keycode'],$_POST['empresa'],$_POST['modelo']);
			if($model!==null){
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