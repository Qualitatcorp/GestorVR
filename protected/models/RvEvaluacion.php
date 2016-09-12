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

	public  function GetCountEva()
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

	public static function FindByEmpresa($emp,$eva=null)
	{
		if($eva!==null)
			$eva+='AND rv_evaluacion.eva_id='.$eva;
		return Yii::app()->db->createCommand("
SELECT 
  rv_evaluacion.nombre as evaluacion,
  year(rv_ficha.creado),
  month(rv_ficha.creado),
  count(*) as `data`
from
  rv_ficha
  inner join rv_evaluacion on (rv_ficha.eva_id = rv_evaluacion.eva_id)
  inner join dispositivo on (rv_ficha.disp_id = dispositivo.dis_id)
  inner join empresa on (dispositivo.emp_id = empresa.emp_id)
where
  empresa.emp_id = $emp $eva
group by
  rv_evaluacion.nombre,
  year(rv_ficha.creado),
  month(rv_ficha.creado)")->queryAll();
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
