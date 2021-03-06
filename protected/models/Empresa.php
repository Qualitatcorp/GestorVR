<?php


class Empresa extends CActiveRecord
{

	public function tableName()
	{
		return 'empresa';
	}

	public function rules()
	{
		return array(

			array('rut', 'unique','message'=>'La empresa ya se encuentra registrada.'),
			array('rut,nombre, razon_social', 'required'),
			array('com_id, giro', 'numerical', 'integerOnly'=>true,'allowEmpty'=>true),
			array('rut', 'length', 'max'=>12),
			array('fono', 'length', 'max'=>50,'allowEmpty'=>true),
			array('activa', 'length', 'max'=>2),
			array('mail', 'email','allowEmpty'=>true),
			array('clasificacion','in','range'=>array('Sobre 100','Sobre 20','Sobre 10','Sobre 7','Sobre 6','Sobre 5','Letras'),'allowEmpty'=>false),
			array('emp_id, nombre, rut, com_id, razon_social, giro, fono, mail, creado, activa', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'comuna' => array(self::BELONGS_TO, 'Comuna', 'com_id'),
			'usuarios' => array(self::HAS_MANY, 'EmpresaUsuario', 'emp_id'),
			'dispositivos' => array(self::HAS_MANY, 'Dispositivo', 'emp_id'),
			'licencias' => array(self::HAS_MANY, 'Licencia', 'emp_id'),
		);
	}
	public function getUsers(){
		$u = array();
		foreach($this->Usuarios as $rel)
			$u[] = $rel->user0;
		return $u;
	}
	public function getAsignaciones(){
		$descr = "";
		foreach($this->users as $u){
			$u->getUserDescription(true); 
			$descr .= $u->getCustomFieldValue('nombre')." ".$u->getCustomFieldValue('paterno')." ".$u->getCustomFieldValue('materno').", ";
		}
		return trim($descr," ,");
	}
	public function attributeLabels()
	{
		return array(
			'emp_id' => Yii::t('Navbar','Empresa'),
			'nombre' => Yii::t('Navbar','Nombre Corto'),
			'rut' => Yii::t('Navbar','RUT'),
			'com_id' => Yii::t('Navbar','Comuna'),
			'razon_social' => Yii::t('Navbar','Razon Social'),
			'giro' => Yii::t('Navbar','Giro'),
			'fono' => Yii::t('Navbar','Fono'),
			'mail' => Yii::t('Navbar','Mail'),
			'creado' =>Yii::t('Navbar','Creado'),
			'activa' => Yii::t('Navbar','Activa'),
			'clasificacion'=>Yii::t('Navbar','Calificación'),
		);
	}
	public function findByRUT($rut)
	{
		return Empresa::model()->find("rut='$rut'");
	}

	public function findByMetodo($ID,$metodo)
	{
		switch ($metodo) {
			case 'RUT_EMPRESA':
				return Empresa::model()->find("rut='$ID'");
				break;			
			case 'ID_EMPRESA':
				return Empresa::model()->findByPk($ID);
				break;
			case 'ID_DEVICE':
				$disp=Dispositivo::model()->find("keycode='$ID'");
				if(!empty($disp)){
					return $disp->empresa;
				}else{
					die("El dispositivo no existe");
				}
				break;
			default:
				die("No existe metodo -> Empresa");
				break;
		}
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
	public function getEvaluaciones()
	{
		return RvEvaluacion::findAllByEmpresa($this->emp_id);
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
