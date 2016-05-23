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
	//Obtencion de datos extra
	public function getTipoNombre()
	{
		return RvTipo::model()->findByPk($this->tev_id)->nombre;
	}
	public function getCountEva()
	{
		return RvFicha::model()->count('eva_id='.$this->eva_id);
	}
	public function getPreguntas()
	{
		return RvPregunta::model()->findAll('eva_id='.$this->eva_id);
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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
