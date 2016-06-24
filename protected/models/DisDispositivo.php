<?php
class DisDispositivo extends CActiveRecord
{
	public function tableName()
	{
		return 'dis_dispositivo';
	}
	public function rules()
	{
		return array(
			array('dit_id, habilitado, activado', 'required'),
			array('emp_id, dit_id', 'numerical', 'integerOnly'=>true),
			array('habilitado, activado', 'length', 'max'=>2),
			array('keycode, serial', 'safe'),
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
			'dis_id' => 'Dis',
			'emp_id' => 'Empresa',
			'dit_id' => 'Dispositivo',
			'creado' => 'Creado',
			'habilitado' => 'Habilitado',
			'activado' => 'Activado',
			'keycode' => 'Keycode',
			'serial' => 'Serial',
		);
	}

	public function getNombre()
	{
		return DisTipo::model()->findByPk($this->dit_id)->nombre;
	}	
	public function getEmpresa()
	{
		return Empresa::model()->findByPk($this->emp_id)->nombre;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
