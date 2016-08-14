<?php
class User extends CActiveRecord
{
	public function tableName()
	{
		return 'usuario_user';
	}

	public function rules()
	{
		return array(
			array('state, totalsessioncounter, currentsessioncounter', 'numerical', 'integerOnly'=>true),
			array('regdate, actdate, logondate', 'length', 'max'=>30),
			array('username, password', 'length', 'max'=>64),
			array('email', 'length', 'max'=>45),
			array('authkey', 'length', 'max'=>100),
			array('iduser, regdate, actdate, logondate, username, email, password, authkey, state, totalsessioncounter, currentsessioncounter', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'usuarioAuthitems' => array(self::MANY_MANY, 'Authitem', 'usuario_authassignment(userid, itemname)'),
			'fieldvalues' => array(self::HAS_MANY, 'Fieldvalue', 'iduser'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'iduser' => 'Usuario',
			'regdate' => 'Regdate',
			'actdate' => 'Actdate',
			'logondate' => 'Logondate',
			'username' => 'RUT',
			'email' => 'Email',
			'password' => 'Contraseña',
			'authkey' => 'Authkey',
			'state' => 'Estado',
			'totalsessioncounter' => 'Totalsessioncounter',
			'currentsessioncounter' => 'Currentsessioncounter',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('regdate',$this->regdate,true);
		$criteria->compare('actdate',$this->actdate,true);
		$criteria->compare('logondate',$this->logondate,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('authkey',$this->authkey,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('totalsessioncounter',$this->totalsessioncounter);
		$criteria->compare('currentsessioncounter',$this->currentsessioncounter);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
