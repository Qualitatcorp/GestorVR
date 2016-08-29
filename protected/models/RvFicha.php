<?php
class RvFicha extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_ficha';
	}
	public function rules()
	{
		return array(
			array('trab_id,disp_id', 'required'),
			array('trab_id,disp_id', 'length', 'max'=>10),
			array('fic_id, trab_id, disp_id,creado', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'respuestas' => array(self::HAS_MANY, 'RvRespuesta', 'fic_id'),
			'trabajador' => array(self::BELONGS_TO, 'Trabajador', 'trab_id'),
			'dispositivo' => array(self::BELONGS_TO, 'Dispositivo', 'disp_id'),
			'evaluacion' => array(self::BELONGS_TO, 'RvEvaluacion', 'eva_id'),
			'RvProyecto' => array(self::BELONGS_TO, 'RvProyecto', 'pro_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'fic_id' => 'Ficha',
			'trab_id' => 'Trabajador',
			'disp_id' => 'Dispositivo',
			'creado' => 'Creado',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('fic_id',$this->fic_id,true);
		$criteria->compare('trab_id',$this->trab_id,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNota()
	{
		if(is_null($this->porcentajeCorrecto)){
			return '-';
		}else{
			return number_format(1+6*$this->porcentajeCorrecto,1);
		}
	}
	public function getPorcentajeCorrecto()
	{
		$total=0;
		$suma=0;
		foreach ($this->respuestas as $resp) {
			$alt=$resp->alternativa;
			if($alt->pregunta->active){
				$total+=$alt->ponderacion;
				if($alt->correcta=='SI')
					$suma+=$alt->ponderacion;
			}
		}
		return ($total!=0)?$suma/$total:null;
	}
	public function command()
	{

		$command=Yii::app()->db->createCommand()
		->select('rv_ficha.fic_id,rv_evaluacion.eva_id,trabajador.tra_id,empresa.emp_id')
		->from('rv_ficha')
		->join('trabajador','rv_ficha.trab_id=trabajador.tra_id')
		->join('rv_evaluacion', 'rv_ficha.eva_id = rv_evaluacion.eva_id')
		->join('dispositivo','rv_ficha.disp_id=dispositivo.dis_id')
		->leftJoin('empresa','dispositivo.emp_id=empresa.emp_id');
		return $command;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
