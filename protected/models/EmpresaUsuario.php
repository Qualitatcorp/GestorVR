<?php
class EmpresaUsuario extends CActiveRecord
{
	public $rut;
	public $email;
	public $password;
	public $role;

	public function tableName()
	{
		return 'empresa_usuario';
	}
	public function rules()
	{
		return array(
			array('rut,email,password,role,emp_id,nombres', 'required','on'=>'insert'),
			array('emp_id, usu_id', 'numerical', 'integerOnly'=>true),
			array('nombres, paterno, materno, fono', 'length', 'max'=>150),			
			array('email','unique','className'=>'CrugeStoredUser','attributeName'=>'email','message'=>'Este email ya se encuentra en uso','on'=>'insert'),
			array('rut','unique','className'=>'CrugeStoredUser','attributeName'=>'username','message'=>'Este rut ya se encuentra en uso','on'=>'insert'),
			array('email','email'),
			array('emu_id, emp_id, usu_id, nombres, paterno, materno, fono', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'emp' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
			'usu' => array(self::BELONGS_TO, 'CrugeStoredUser', 'usu_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'emu_id' => 'Emu',
			'emp_id' => 'Empresa',
			'usu_id' => 'Usuario',
			'nombres' => 'Nombres',
			'paterno' => 'Apellido Paterno',
			'materno' => 'Apellido Materno',
			'fono' => 'Fono',
			'rut' => 'RUT',
			'email' => 'email',
			'role' => 'ROL',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('emu_id',$this->emu_id,true);
		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('usu_id',$this->usu_id);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('paterno',$this->paterno,true);
		$criteria->compare('materno',$this->materno,true);
		$criteria->compare('fono',$this->fono,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNombreCompleto()
	{
		return implode(' ',array($this->nombres,$this->paterno,$this->materno));
	}
	public function getRUT()
	{
		return $this->usu->username;
	}

	// public function __get($name){
	
	// 	$field = Yii::app()->user->um->loadFieldByName($name);
	// 	if($field != null)
	// 		return Yii::app()->user->um->getFieldValue($this->usu,$field);
	// 	return parent::__get($name);
	// }
	// public function __set($name,$val){
	
	// 	$field = Yii::app()->user->um->loadFieldByName($name);
	// 	if($field != null)
	// 		return;
	// 	return parent::__set($name,$val);
	// }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
