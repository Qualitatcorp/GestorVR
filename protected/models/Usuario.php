<?php

class Usuario extends CActiveRecord
{

	public function tableName()
	{
		return 'usuario';
	}

	public function rules()
	{

		return array(
			array('usu_rut, emp_rut, car_id, usu_nombre, usu_apellido, usu_password, usu_rol, usu_fono, usu_email', 'required'),
			array('usu_desabilitado', 'numerical', 'integerOnly'=>true),
			array('usu_rut, emp_rut', 'length', 'max'=>13),
			array('car_id', 'length', 'max'=>10),
			array('usu_nombre, usu_email', 'length', 'max'=>256),
			array('usu_apellido', 'length', 'max'=>512),
			array('usu_password', 'length', 'max'=>128),
			array('usu_rol', 'length', 'max'=>32),
			array('usu_fono', 'length', 'max'=>64),
		);
	}

	public function attributeLabels()
	{
		return array(
			'usu_rut' => 'RUT',
			'emp_rut' => 'Empresa',
			'car_id' => 'Cargo',
			'usu_nombre' => 'Nombres',
			'usu_apellido' => 'Apellidos',
			'usu_password' => 'Password',
			'usu_rol' => 'Rol',
			'usu_fono' => 'Fono',
			'usu_email' => 'Email',
			'usu_fecha_creacion' => 'Creación',
			'usu_desabilitado' => 'Desabilitado',
		);
	}

	public function getCar_nombre()
	{
		return ($model=Cargo::findByPk($this->car_id))?$model->car_nombre:"SIN CARGO";
	}

	public function getemp_nombre()
	{
		return ($model=Empresa::findByPk($this->emp_rut))?$model->emp_nombre:"SIN EMPRESA";
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if ($model=Usuario::model()->findByPk($this->usu_rut)) {
				if ($this->usu_password!=$model->usu_password)
				$this->usu_password=md5($this->usu_password);
			} 
			else $this->usu_password=md5($this->usu_password);
			return true;
		}
		return false;
	}
}
