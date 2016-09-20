<?php

/**
 * This is the model class for table "rv_proyecto".
 *
 * The followings are the available columns in table 'rv_proyecto':
 * @property string $pro_id
 * @property string $nombre
 * @property string $descripcion
 */
class RvProyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('pro_id', 'length', 'max'=>10),
			array('nombre', 'length', 'max'=>300),
			array('pro_id, nombre, descripcion', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'fichas' => array(self::HAS_MANY, 'RvFicha', 'disp_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'pro_id' => 'Pro',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('pro_id',$this->pro_id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function findByNombre($nombre)
	{
		$model=RvProyecto::model()->find("nombre='$nombre'");
		if(empty($model)){
			$model=new RvProyecto;
			$model->nombre=$nombre;
			if(!$model->save())
				var_dump($model->getErrors());
		}
		return $model;
	}
}
