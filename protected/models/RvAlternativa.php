<?php
class RvAlternativa extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_alternativa';
	}
	public function rules()
	{
		return array(
			array('alternativa, ponderacion, correcta', 'required'),
			array('ponderacion', 'numerical', 'integerOnly'=>true),
			array('pre_id, alternativa', 'length', 'max'=>10),
			array('correcta', 'length', 'max'=>2),
			array('descripcion', 'safe'),
			array('alt_id, pre_id, alternativa, descripcion, ponderacion, correcta', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'respuestas' => array(self::HAS_MANY, 'RvRespuesta', 'alt_id'),
			'pregunta' => array(self::BELONGS_TO, 'RvPregunta', 'pre_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'alt_id' => 'Alt',
			'pre_id' => 'Pre',
			'alternativa' => 'Alternativa',
			'descripcion' => 'Descripcion',
			'ponderacion' => 'Ponderacion',
			'correcta' => 'Correcta',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('alt_id',$this->alt_id,true);
		$criteria->compare('pre_id',$this->pre_id,true);
		$criteria->compare('alternativa',$this->alternativa,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('ponderacion',$this->ponderacion);
		$criteria->compare('correcta',$this->correcta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findByPregunta($pregunta,$alternativa)
	{
		return RvAlternativa::model()->find("alternativa='$alternativa' AND pre_id=$pregunta");
	}
	public function getRenderCorrecto()
	{
		if($this->correcta=='SI'){
			return BsHtml::imageCircle(Yii::app()->request->baseUrl.'/images/ficha/correcto.jpg','pregunta',array('height'=>'50x','width'=>'50px'));
		}else{
			return BsHtml::imageCircle(Yii::app()->request->baseUrl.'/images/ficha/incorrecto.jpg','pregunta',array('height'=>'50x','width'=>'50px'));
		}
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
