<?php

class LicenciaRegistro extends CActiveRecord
{

	public function tableName()
	{
		return 'licencia_registro';
	}

	public function rules()
	{
		return array(
			array('lic_id, iduser, descripcion', 'required'),
			array('lic_id, iduser, cantidad', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>5),
			array('habilitado', 'length', 'max'=>2),
			array('lig_id, lic_id, iduser, cantidad, tipo, descripcion, habilitado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}
	public function attributeLabels()
	{
		return array(
			'lig_id' => 'Lig',
			'lic_id' => 'Lic',
			'iduser' => 'Iduser',
			'cantidad' => 'Cantidad',
			'tipo' => 'Tipo',
			'descripcion' => 'Descripcion',
			'habilitado' => 'Habilitado',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('lig_id',$this->lig_id);
		$criteria->compare('lic_id',$this->lic_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('descripcion',$this->descripcion);
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
