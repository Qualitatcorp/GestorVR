<?php
class Dispositivo extends CActiveRecord
{
	public function tableName()
	{
		return 'dispositivo';
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
			'emp' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
			'tipo' => array(self::BELONGS_TO, 'DispositivoTipo', 'dit_id'),
			'fichas' => array(self::HAS_MANY, 'RvFicha', 'disp_id'),
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
		return DispositivoTipo::model()->findByPk($this->dit_id)->nombre;
	}	
	public function getEmpresa()
	{
		return Empresa::model()->findByPk($this->emp_id)->nombre;
	}

	public function findByKeycode($keycode,$empresa=null,$modelo=null,$activado='SI',$habilitado='NO')
	{
		$model=$model=Dispositivo::model()->find("keycode='$keycode'");
		if(($empresa=Empresa::model()->findByRUT($empresa))!==null){
			$model=Dispositivo::model()->find("keycode='$keycode' AND emp_id=".$empresa->primaryKey);
		}
		if($model===null&&$empresa!==null&&$modelo!==null){
			$model=new Dispositivo;
			$model->keycode=$keycode;
			$model->activado=$activado;
			$model->habilitado=$habilitado;
			$model->emp_id=$empresa->primaryKey;
			$model->dit_id=DispositivoTipo::model()->findByModelo($modelo)->primaryKey;
			$model->save();
		}
		return $model;
	}
	public function verifySerial($serial)
	{
		if($this->serial==$serial){
			$this->habilitado='SI';
			$this->save();
			return true;
		}else{
			return false;
		}
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
