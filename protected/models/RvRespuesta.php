<?php
class RvRespuesta extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_respuesta';
	}
	public function rules()
	{
		return array(
			array('alt_id', 'required'),
			array('alt_id, fic_id', 'length', 'max'=>10),
			array('res_id, alt_id, fic_id, creado', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{ 
		return array(
			'ficha' => array(self::BELONGS_TO, 'RvFicha', 'fic_id'),
			'alternativa' => array(self::BELONGS_TO, 'RvAlternativa', 'alt_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'res_id' => 'Res',
			'alt_id' => 'Alt',
			'fic_id' => 'Fic',
			'creado' => 'Creado',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('alt_id',$this->alt_id,true);
		$criteria->compare('fic_id',$this->fic_id,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
