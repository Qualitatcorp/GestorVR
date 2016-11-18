<?php
class Pais extends CActiveRecord
{
	public function tableName()
	{
		return 'pais';
	}
	// public function rules()
	// {
	// 	return array(
	// 		array('codigo, nombre', 'required'),
	// 		array('codigo', 'length', 'max'=>2),
	// 		array('nombre', 'length', 'max'=>50),
	// 		array('pais_id, codigo, nombre', 'safe', 'on'=>'search'),
	// 	);
	// }
	public function relations()
	{
		return array(
			'fichas' => array(self::HAS_MANY, 'RvFicha', 'pais_id'),
		);
	}

	public function findByCodigo($codigo="CL")
	{
		return Pais::model()->find("t.codigo='$codigo'");
	}

	public function attributeLabels()
	{
		return array(
			'pais_id' => 'Pais',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
		);
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
