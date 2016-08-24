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
			'trabajador' => array(self::BELONGS_TO, 'Trabajador', 'trab_id'),
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
	public function getEvaluacion()
	{
		$command = Yii::app()->db->createCommand("
		SELECT DISTINCT 
		  rv_pregunta.eva_id
		FROM
		  rv_pregunta
		  INNER JOIN rv_alternativa ON (rv_pregunta.pre_id = rv_alternativa.pre_id)
		  INNER JOIN rv_respuesta ON (rv_respuesta.alt_id = rv_alternativa.alt_id)
		  INNER JOIN rv_ficha ON (rv_respuesta.fic_id = rv_ficha.fic_id)
		WHERE
		  rv_ficha.fic_id = $this->fic_id
		GROUP BY
		  rv_pregunta.eva_id")->queryRow();
		return RvEvaluacion::model()->findByPk($command['eva_id']);
	}
	public function getNota()
	{
		$preguntas=$this->evaluacion->preguntas;

		return 1;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
