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
		RvFicha::model()->count('t.eva_id='.$this->eva_id);
	}
	public static function FindByEmpresa($emp,$eva=null)
	{
		if(!empty($eva))
			$eva='AND rv_evaluacion.eva_id='.$eva;
		return Yii::app()->db->createCommand("
			SELECT
				rv_evaluacion.nombre as EVALUACION,
				year(rv_ficha.creado) as YEAR,
				month(rv_ficha.creado) as MONTH,
				count(*) as `DATA`
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
				month(rv_ficha.creado)
		  ")->queryAll();
	}
	public function traduce()
	{
		if(Yii::app()->language!='es'){
			$model=RvIntEvaluacion::findByLanguage($this->primaryKey,Yii::app()->language);
			if(!empty($model)){
				if(!empty($model->nombre)){
					$this->nombre=$model->nombre;
				}				
				if(!empty($model->descripcion)){
					$this->descripcion=$model->descripcion;
				}
			}
		}
		return $this;
	}
	public static function findAllByEmpresa($emp)
	{
		return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) WHERE `t`.`eva_id` = `rv_ficha`.`eva_id` and `dispositivo`.`emp_id`=$emp)");
	}
	public static function findAllByUsuario($usu)
	{
		return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_dispositivo` ON (`dispositivo`.`dit_id` = `empresa_dispositivo`.`dis_id`) WHERE t.`eva_id`=`rv_ficha`.`eva_id` and `empresa_dispositivo`.`emu_id`=$usu)");
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
	public function getisInternational()
	{
		return $this->exists("EXISTS(SELECT *  FROM rv_pregunta JOIN rv_int_pregunta ON (rv_pregunta.`pre_id` = `rv_int_pregunta`.`pre_id`) WHERE rv_pregunta.eva_id=$this->eva_id)");
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
