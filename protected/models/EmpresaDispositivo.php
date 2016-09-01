<?php

class EmpresaDispositivo extends CActiveRecord
{
	public function tableName()
	{
		return 'empresa_dispositivo';
	}

	public function rules()
	{
		return array(
			array('dis_id, emu_id', 'required'),
			array('dis_id', 'length', 'max'=>10),
			array('emu_id', 'length', 'max'=>11),
			array('emd_id, dis_id, emu_id', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'emu' => array(self::BELONGS_TO, 'EmpresaUsuario', 'emu_id'),
			'dis' => array(self::BELONGS_TO, 'Dispositivo', 'dis_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'emd_id' => 'Emd',
			'dis_id' => 'Dis',
			'emu_id' => 'Emu',
		);
	}
	public function search()
	{
	
		$criteria=new CDbCriteria;

		$criteria->compare('emd_id',$this->emd_id,true);
		$criteria->compare('dis_id',$this->dis_id,true);
		$criteria->compare('emu_id',$this->emu_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
