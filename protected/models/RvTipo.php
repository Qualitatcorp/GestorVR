<?php

/**
 * This is the model class for table "rv_tipo".
 *
 * The followings are the available columns in table 'rv_tipo':
 * @property integer $tev_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $activo
 */
class RvTipo extends CActiveRecord
{

	public function tableName()
	{
		return 'rv_tipo';
	}

	public function rules()
	{
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>250),
			array('activo', 'length', 'max'=>2),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tev_id, nombre, descripcion, activo', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'tev_id' => 'Tev',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'activo' => 'Activo',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('tev_id',$this->tev_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('activo',$this->activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
