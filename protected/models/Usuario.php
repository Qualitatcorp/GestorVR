<?php

class Usuario extends CFormModel
{
	public $rut;
	public $empresa;
	public $nombres;
	public $paterno;
	public $materno;
	public $password;
	public $email;
	public $fono;

	public function rules()
	{
		return array(
			array('rut,email,password','required'),
			array('rut', 'length', 'max'=>13),
			array('empresa', 'numerical', 'integerOnly'=>true),
			// array('rut','validaRut','action'=>'create'),
			array('email','unique','className'=>'User','attributeName'=>'email','message'=>'Este email ya se encuentra en uso'),
			array('rut','unique','className'=>'User','attributeName'=>'username','message'=>'Este rut ya se encuentra en uso'),
			array('email','email'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'rut'=>'RUT',
			'empresa'=>'Empresa',
			'nombres'=>'Nombre',
			'paterno'=>'Apellido Paterno',
			'materno'=>'Apellido Materno',
			'password'=>'Contraseña',
			'email'=>'Correo',
			'fono'=>'Fono'
		);
	}

	// public function validaRut($attribute,$params)
	// {
	// 	if(Yii::app()->controller->action->id==$params['action']){
	// 		if(Yii::app()->user->um->loadUser($this->rut)!=null)
	// 			$this->addError($attribute, 'Este usuario se encuentra en el sistema.');
	// 	}
	// }

	public function save()
	{
		if($this->validate()){
			$usuario = Yii::app()->user->um->createNewUser(array(
				'username'=>$this->rut,
				'email'=>$this->email,
				'nombre'=>$this->nombres,
				'paterno'=>$this->paterno,
				'materno'=>$this->materno,
				'fono'=>$this->fono,
			));
			Yii::app()->user->um->activateAccount($usuario);
			Yii::app()->user->um->changePassword($usuario,$this->password);
			if(Yii::app()->user->um->save($usuario)){
				return true;
			}else{
				return false;
			}
		}
	}
}
