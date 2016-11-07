<?php
class EmpresaUsuario extends CActiveRecord
{
	public $rut;
	public $email;
	public $password;
	public $role;
	public $disp;

	public function tableName()
	{
		return 'empresa_usuario';
	}
	public function rules()
	{
		return array(
			array('rut,email,role,emp_id,nombres,clasificacion', 'required','on'=>'insert'),
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
			'dis' => array(self::HAS_MANY, 'EmpresaDispositivo', 'emu_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'emu_id' => 'Emu',
			'emp_id' => Yii::t('Navbar','Empresa'),
			'usu_id' => Yii::t('Navbar','Usuario'),
			'nombres' => Yii::t('Navbar','Nombres'),
			'paterno' => Yii::t('Navbar','Apellido Paterno'),
			'materno' => Yii::t('Navbar','Apellido Materno'),
			'fono' => Yii::t('Navbar','Fono'),
			'Rut' => Yii::t('Navbar','RUT'),
			'email' => Yii::t('Navbar','Email'),
			'role' =>Yii::t('Navbar','ROL'),
			'disp' => Yii::t('Navbar','Dispositivos'),
			'countEvaluaciones'=>Yii::t('Navbar','Total de evaluaciones'),
			'password'=>Yii::t('Navbar','Contraseña'),
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

	public function setDisp()
	{
		EmpresaDispositivo::model()->deleteAll("emu_id=$this->primaryKey");
		if($this->disp!==''){
			foreach ($this->disp as $key) {
				$model=new EmpresaDispositivo;
				$model->emu_id=$this->primaryKey;
				$model->dis_id=$key;
				if($model->save()){

				}else{
					die(Yii::t('Navbar','No guardo'));
				}

			}	
		}		
	}
	public function getDisp()
	{
		$this->disp=array();
		foreach ($this->dis as $value) {
			$this->disp[]=$value->dis->primaryKey;
		};
		return $this->disp;
	}
	public static function findByID($id='')
	{
		if($id==='')
			$id = Yii::app()->user->id;
		return EmpresaUsuario::model()->find('usu_id='.$id);
	}
	public function getCountEvaluaciones()
	{
		return RvFicha::CountByUsuario($this->emu_id);
	}
	public function getEvaluaciones()
	{
		return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `empresa_dispositivo` INNER JOIN `rv_ficha` ON (`empresa_dispositivo`.`dis_id` = `rv_ficha`.`disp_id`) WHERE `rv_ficha`.`eva_id` = `t`.`eva_id` AND `empresa_dispositivo`.`emd_id` = $this->emu_id)");
	}
	public function ExistUsuarioEmpresa($emp,$usu)
	{
		return EmpresaUsuario::model()->exists("t.emp_id=$emp AND t.emu_id=$usu");
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
