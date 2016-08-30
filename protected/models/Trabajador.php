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
			array('rut', 'required'),
			array('rut', 'unique','message'=>'El trabajador ya se encuentra registrado.'),
			array('rut', 'length', 'max'=>12),
			array('rut', 'valida_rut'),/* 'attributeName'=>'rut', 'className'=>'cliente','allowEmpty'=>'false'),*/
			array('nombre', 'length', 'max'=>150),
			array('paterno, materno', 'length', 'max'=>100),
			array('fono', 'length', 'max'=>50),
			array('nacimiento, mail, modificado', 'safe'),
			array('tra_id, rut, nombre, paterno, materno, nacimiento, fono, mail, creacion, modificado', 'safe', 'on'=>'search'),
		);
	}


	public function valida_rut($attribute, $params){
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
			'nacimiento' => 'Nacimiento',
			'fono' => 'Fono',
			'mail' => 'Mail',
			'creacion' => 'Creación',
			'modificado' => 'Modificado',
		);
	}
	public function checkRut($rut)
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
	public function getNombreCompleto()
	{
		return implode(" ", array($this->paterno,$this->materno,$this->nombre));
	}
	public function findAllByEmpresa($id)
	{
		return Trabajador::findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa` ON (`dispositivo`.`emp_id` = `empresa`.`emp_id`) INNER JOIN `empresa_usuario` ON (`empresa`.`emp_id` = `empresa_usuario`.`emp_id`) WHERE `rv_ficha`.`trab_id` = `t`.`tra_id` AND `empresa`.`emp_id` = $id)");
	}
	public function findAllByEmpresaUsuario($id)
	{
		return Trabajador::findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_dispositivo` ON (`empresa_dispositivo`.`dis_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_usuario` ON (`empresa_dispositivo`.`emu_id` = `empresa_usuario`.`emu_id`) WHERE `rv_ficha`.`trab_id` = `t`.`tra_id` AND `empresa_usuario`.`usu_id`= $id)");
	}
	public function findByRUT($rut)
	{
		$model=Trabajador::model()->find("rut='$rut'");
		if($model===null){
			$model=new Trabajador;
			$model->rut=$rut;
			$model->save();
		}
		return $model;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
