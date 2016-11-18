<?php
class Trabajador extends CActiveRecord
{
	public function tableName()
	{
		return 'trabajador';
	}
	public function rules()
	{
		return array(
			// array('rut', 'required'),
			array('rut,mail', 'unique','message'=>'El {attribute} ya se encuentra registrado.'),
			array('antiguedad,hijos','numerical',
				'integerOnly'=>true,
				'min'=>0,
				'max'=>70,),
			array('rut', 'length', 'max'=>12),
			array('rut', 'valida_rut'),/* 'attributeName'=>'rut', 'className'=>'cliente','allowEmpty'=>'false'),*/
			array('estado_civil,gerencia,cargo,nombre', 'length', 'max'=>150),
			array('paterno, materno', 'length', 'max'=>100),
			array('nacimiento', 'date', 'format'=>'yyyy-mm-dd','allowEmpty'=>true),
			array('rut,nombre,paterno,materno,nacimiento,fono,mail,gerencia,cargo,antiguedad,estado_civil,hijos', 'default', 'setOnEmpty'=>true, 'value'=>null ),
			array('fono', 'length', 'max'=>50),
			array('nacimiento, mail, modificado', 'safe'),
			array('tra_id, rut, nombre, paterno, materno, nacimiento, fono, mail, creacion, modificado', 'safe', 'on'=>'search'),
		);
	}
	public function beforeSave(){
		if(parent::beforeSave()){
			if(empty($this->rut)&&empty($this->mail)&&empty($this->nombre)){
				$this->addError('rut','Debe existir un rut o correo asignado.');
				$this->addError('nombre','Debe existir un rut o correo asignado.');
				$this->addError('mail','Debe existir un rut o correo asignado.');
				return false;
			}
			return true;

		}else{
			return false;
		}

	}

	public function valida_rut($attribute, $params){
		if(empty($this->$attribute)){
			return;
		}
		var_dump($this->$attribute,"Chupala");
		$rut=$this->$attribute;
		if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
			$this->addError($attribute, 'Rut inválido.');
		}
		$rut = preg_replace('/[\.\-]/i', '', $rut);
		$dv = substr($rut, -1);
		$numero = substr($rut, 0, strlen($rut) - 1);
		$i = 2;
		$suma = 0;
		foreach (array_reverse(str_split($numero)) as $v) {
			if ($i == 8)
				$i = 2;
			$suma += $v * $i;
			++$i;
		}
		$dvr = 11 - ($suma % 11);
		if ($dvr == 11)
			$dvr = 0;
		if ($dvr == 10)
			$dvr = 'K';
		if ($dvr != strtoupper($dv))
			$this->addError($attribute, 'Rut inválido.');
	}

	public function relations()
	{
		return array(
		);
	}
	public function attributeLabels()
	{
		return array(
			'tra_id' => 'Trabajador',
			'rut' => 'RUT',
			'nombre' => 'Nombre',
			'paterno' => 'Paterno',
			'materno' => 'Materno',
			'nacimiento' => 'Fecha de nacimiento',
			'fono' => 'Número Telefónico',
			'mail' => 'Correo electrónico',
			'creacion' => 'Creación',
			'modificado' => 'Modificado',
			'gerencia'=>'Gerencia',
			'cargo'=>'Cargo',
			'antiguedad'=>'Antigüedad',
			'estado_civil'=>'Estado civil',
			'hijos'=>'Cantidad de hijos',
			'edad'=>'Edad'
			);
	}
	public static function checkRut($rut)
	{
		if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
			return null;
		}

		$rut = preg_replace('/[\.\-]/i', '', $rut);
		$dv = substr($rut, -1);
		$numero = substr($rut, 0, strlen($rut) - 1);
		$numero = intval($numero);
		$numero = strval($numero);
		$rut=number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );	    $i = 2;
		$suma = 0;
		foreach (array_reverse(str_split($numero)) as $v) {
			if ($i == 8)
				$i = 2;
			$suma += $v * $i;
			++$i;
		}
		$dvr = 11 - ($suma % 11);

		if ($dvr == 11)
			$dvr = 0;
		if ($dvr == 10)
			$dvr = 'K';
		if ($dvr == strtoupper($dv))
			return $rut;
		else
			return null;
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('tra_id',$this->tra_id,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('paterno',$this->paterno,true);
		$criteria->compare('materno',$this->materno,true);
		$criteria->compare('nacimiento',$this->nacimiento,true);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('creacion',$this->creacion,true);
		$criteria->compare('modificado',$this->modificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getEdad()
	{
		if(!empty($this->nacimiento)){
			return strval(DateTime::createFromFormat('Y-m-d',$this->nacimiento)
				->diff(new DateTime('now'))
				->y);
		}else{
			return null;
		}
	}
	public function getNombreCompleto()
	{
		return implode(" ", array($this->paterno,$this->materno,$this->nombre));
	}
	public static function findAllByEmpresa($id)
	{
		return Trabajador::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa` ON (`dispositivo`.`emp_id` = `empresa`.`emp_id`) INNER JOIN `empresa_usuario` ON (`empresa`.`emp_id` = `empresa_usuario`.`emp_id`) WHERE `rv_ficha`.`trab_id` = `t`.`tra_id` AND `empresa`.`emp_id` = $id)");
	}
	public static function findAllByEmpresaUsuario($id)
	{
		return Trabajador::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_dispositivo` ON (`empresa_dispositivo`.`dis_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_usuario` ON (`empresa_dispositivo`.`emu_id` = `empresa_usuario`.`emu_id`) WHERE `rv_ficha`.`trab_id` = `t`.`tra_id` AND `empresa_usuario`.`usu_id`= $id)");
	}
	public static function findByRUT($rut)
	{
		$model=Trabajador::model()->find("t.rut='$rut'");
		if($model===null){
			$model=new Trabajador;
			$model->rut=$rut;
			$model->save();
		}
		return $model;
	}	
	public static function findByMail($mail)
	{
		$model=Trabajador::model()->find("t.mail='$mail'");
		if($model===null){
			$model=new Trabajador;
			$model->mail=$mail;
			$model->save();
		}
		return $model;
	}
	public function findByNombre($nombres)
	{
		$model;
		if(strpos($nombres,',')){
			$persona=explode(",", $nombres);
			if(count($persona)==3){
				$atTrab=array(
					'nombre' => $persona[0],
					'paterno' => $persona[1],
					'materno' => $persona[2]);
				$model=Trabajador::model()->findByAttributes($atTrab);
				if(empty($model)){	
					$model=new Trabajador;
					$model->attributes=$atTrab;
					$model->save();
				}
			}
		}else{
			$model=Trabajador::model()->findByAttributes(
				array(
					'nombre' => $nombres,
					'paterno' => null,
					'materno' => null
				));
			if(empty($model)){
					$model=new Trabajador;
					$model->nombre=$nombres;
					$model->save();
				}
		}
		return $model;
	}
	public function findByMetodo($ID,$metodo)
	{
		switch ($metodo) {
			case 'RUT_TRABAJADOR':
				return Trabajador::model()->findByRUT($ID);
				break;
			case 'MAIL_TRABAJADOR':
				return Trabajador::model()->findByMail($ID);
				break;
			case 'ID_TRABAJADOR':
				return Trabajador::model()->findByPk($ID);
				break;
			case 'NOMBRE_TRABAJADOR':
				return Trabajador::model()->findByNombre($ID);
				break;
			default:
				die("No existe metodo -> Empresa -> $metodo to $ID");
				break;
		}
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
