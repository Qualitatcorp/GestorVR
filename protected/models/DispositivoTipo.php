<?php

/**
 * This is the model class for table "dis_tipo".
 *
 * The followings are the available columns in table 'dis_tipo':
 * @property integer $dit_id
 * @property string $nombre
 * @property string $descripcion
 */
class DispositivoTipo extends CActiveRecord
{
	public function tableName()
	{
		return 'dispositivo_tipo';
	}
	public function rules()
	{
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>200),
			array('descripcion', 'safe'),
			array('dit_id, nombre, descripcion', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'Dispositivos' => array(self::HAS_MANY, 'Dispositivo', 'dit_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'dit_id' => 'Dit',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripción',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('dit_id',$this->dit_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function findByModelo($modelo)
	{
		$model=DispositivoTipo::model()->find("modelo='$modelo'");
		if($model===null){
			$model=new DispositivoTipo;
			$model->nombre=$modelo;
			$model->modelo=$modelo;
			$model->save();
		}
		return $model;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
