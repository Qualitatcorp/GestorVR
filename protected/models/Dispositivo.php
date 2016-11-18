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
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
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

	public function findByKeycode($keycode,$empresa=null)
	{

		$model=$model=Dispositivo::model()->find("keycode='$keycode'");
		if(!empty($empresa)){
			$model=Dispositivo::model()->find("keycode='$keycode' AND emp_id=".$empresa->primaryKey);
		}
		if(empty($model)&&!empty($empresa)){
			$model=new Dispositivo;
			$model->keycode=$keycode;
			$model->activado='SI';
			$model->habilitado='NO';
			$model->emp_id=$empresa->primaryKey;
			if(isset($_POST['modelo'])){
				$model->dit_id=DispositivoTipo::model()->findByModelo($_POST['modelo'])->primaryKey;
			}else{
				$model->dit_id=DispositivoTipo::model()->findByModelo("-")->primaryKey;
			}
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
	public function getAlternativo()
	{
		if($this->nombre=='')
			return $this->tipo->nombre;
		else
			return $this->nombre;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
