<?php

class RvEvaluacion extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_evaluacion';
	}

	public function rules()
	{
		return array(
			array('tev_id, nombre,', 'required'),
			array('tev_id', 'numerical', 'integerOnly'=>true),
			array('habilitado', 'length', 'max'=>2),
			array('descripcion', 'safe'),
			array('eva_id, tev_id, nombre, descripcion, creado, habilitado', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'preguntas' => array(self::HAS_MANY, 'RvPregunta', 'eva_id'),
			'tipo' => array(self::BELONGS_TO, 'RvTipo', 'tev_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'eva_id' => 'Evaluación',
			'tev_id' => 'Tipo evaluación',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripción',
			'creado' => 'Creado',
			'habilitado' => 'Habilitado',
			'countEva' => 'Cantidad de evaluaciones',
		);
	}

	public function GetCountEva()
	{

		$datos= Yii::app()->db->createCommand("
			SELECT 
			  COUNT(DISTINCT rv_ficha.fic_id) AS FICHAS
			FROM
			  rv_pregunta
			  INNER JOIN rv_evaluacion ON (rv_pregunta.eva_id = rv_evaluacion.eva_id)
			  INNER JOIN rv_alternativa ON (rv_pregunta.pre_id = rv_alternativa.pre_id)
			  INNER JOIN rv_respuesta ON (rv_respuesta.alt_id = rv_alternativa.alt_id)
			  INNER JOIN rv_ficha ON (rv_respuesta.fic_id = rv_ficha.fic_id)
			WHERE
			  rv_evaluacion.eva_id = $this->eva_id
			GROUP BY
			  rv_evaluacion.eva_id")
		->queryRow();
		return $datos['FICHAS'];
	}

	public function FindByEmpresa($emp,$eva=null)
	{
		if($eva!==null)
			$eva+='AND RV_EVALUACION.EVA_ID='.$eva;
		return Yii::app()->db->createCommand("
SELECT 
  `RV_EVALUACION`.`NOMBRE` AS `EVALUACION`,
  YEAR(`RV_FICHA`.`CREADO`) AS YEAR,
  MONTH(`RV_FICHA`.`CREADO`) AS MONTH,
  COUNT(*) AS `DATA`
FROM
  `RV_FICHA`
  INNER JOIN `RV_EVALUACION` ON (`RV_FICHA`.`EVA_ID` = `RV_EVALUACION`.`EVA_ID`)
  INNER JOIN `DISPOSITIVO` ON (`RV_FICHA`.`DISP_ID` = `DISPOSITIVO`.`DIS_ID`)
  INNER JOIN `EMPRESA` ON (`DISPOSITIVO`.`EMP_ID` = `EMPRESA`.`EMP_ID`)
WHERE
  `EMPRESA`.`EMP_ID` = $emp $eva
GROUP BY
  `RV_EVALUACION`.`NOMBRE`,
  YEAR(`RV_FICHA`.`CREADO`),
  MONTH(`RV_FICHA`.`CREADO`)
ORDER BY
  `EVALUACION`")->queryAll();
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('eva_id',$this->eva_id,true);
		$criteria->compare('tev_id',$this->tev_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('habilitado',$this->habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
