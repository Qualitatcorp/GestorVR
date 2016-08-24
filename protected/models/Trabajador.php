<?php
class Trabajador extends CActiveRecord
{
	public function tableName()
	{
		return 'trabajador';
	}
	public function rules()
	{
		return array(
			array('rut', 'required'),
			array('rut', 'unique','message'=>'El trabajador ya se encuentra registrado.'),
			array('rut', 'length', 'max'=>12),
			array('nombre', 'length', 'max'=>150),
			array('paterno, materno', 'length', 'max'=>100),
			array('fono', 'length', 'max'=>50),
			array('nacimiento, mail, modificado', 'safe'),
			array('tra_id, rut, nombre, paterno, materno, nacimiento, fono, mail, creacion, modificado', 'safe', 'on'=>'search'),
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
			'tra_id' => 'Trabajador',
			'rut' => 'RUT',
			'nombre' => 'Nombre',
			'paterno' => 'Paterno',
			'materno' => 'Materno',
			'nacimiento' => 'Nacimiento',
			'fono' => 'Fono',
			'mail' => 'Mail',
			'creacion' => 'Creación',
			'modificado' => 'Modificado',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('tra_id',$this->tra_id,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('paterno',$this->paterno,true);
		$criteria->compare('materno',$this->materno,true);
		$criteria->compare('nacimiento',$this->nacimiento,true);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('creacion',$this->creacion,true);
		$criteria->compare('modificado',$this->modificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNombreCompleto()
	{
		return implode(" ", array($this->paterno,$this->materno,$this->nombre));
	}
	public function findByRUT($rut)
	{
		$model=Trabajador::model()->find("rut='$rut'");
		if($model===null){
			$model=new Trabajador;
			$model->rut=$rut;
			$model->save();
		}
		return $model;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
