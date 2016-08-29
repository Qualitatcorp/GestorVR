<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $emp_id
 * @property string $nombre
 * @property string $rut
 * @property integer $com_id
 * @property string $razon_social
 * @property integer $giro
 * @property string $fono
 * @property string $mail
 * @property string $creado
 * @property string $activa
 */
class Empresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, com_id, razon_social', 'required'),
			array('com_id, giro', 'numerical', 'integerOnly'=>true),
			array('rut', 'length', 'max'=>12),
			array('fono', 'length', 'max'=>50),
			array('activa', 'length', 'max'=>2),
			array('mail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_id, nombre, rut, com_id, razon_social, giro, fono, mail, creado, activa', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'usuarios' => array(self::HAS_MANY, 'EmpresaUsuario', 'emp_id'),
			'dispositivos' => array(self::HAS_MANY, 'Dispositivo', 'emp_id'),
			'licencias' => array(self::HAS_MANY, 'Licencia', 'emp_id'),
		);
	}
	public function getUsers(){
		$u = array();
		var_dump($this->Usuarios);
		foreach($this->Usuarios as $rel)
			$u[] = $rel->user0;
		return $u;
	}
	public function getAsignaciones(){
		$descr = "";
		foreach($this->users as $u){
			$u->getUserDescription(true); 
			$descr .= $u->getCustomFieldValue('nombre').
				" ".$u->getCustomFieldValue('paterno')." ".$u->getCustomFieldValue('materno').", ";
		}
		return trim($descr," ,");
	}
	public function attributeLabels()
	{
		return array(
			'emp_id' => 'Empresa',
			'nombre' => 'Nombre Corto',
			'rut' => 'RUT',
			'com_id' => 'Comuna',
			'razon_social' => 'Razon Social',
			'giro' => 'Giro',
			'fono' => 'Fono',
			'mail' => 'Mail',
			'creado' => 'Creado',
			'activa' => 'Activa',
		);
	}
	public function findByRUT($rut)
	{
		return Empresa::model()->find("rut='$rut'");
	}


	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('com_id',$this->com_id);
		$criteria->compare('razon_social',$this->razon_social,true);
		$criteria->compare('giro',$this->giro);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('activa',$this->activa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
