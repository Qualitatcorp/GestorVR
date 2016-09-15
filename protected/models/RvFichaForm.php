<?php 
/**
* RvFichaForm
*/
class RvFichaForm extends CFormModel
{
	//Variables de Forulario
	public $ficha;//numero de ficha
	public $trabajador;//id trabajador
	public $evaluacion;//id evaluacion
	public $inicio;//Fecha de inicio
	public $termino;//Fecha de termino
	public $proyecto;//id proyecto
	public $dispositivo;//id dispositivo
	public $limite;//cantidad de fichas a cargar
	public $order; //orden de fecha

	//Variables de control
	public $empresa;//id de la empresa
	public $usuario;//id de usuario

	public function rules()
	{
		return array(
			array('ficha','exist','allowEmpty' => true, 'attributeName' => 'fic_id', 'className' => 'RvFicha','message'=>'La ficha no existe'),
			array('trabajador','exist','allowEmpty' => true, 'attributeName' => 'rut', 'className' => 'Trabajador','message'=>'El trabajador no existe', ),
			array('evaluacion','exist','allowEmpty' => true, 'attributeName' => 'eva_id', 'className' => 'RvEvaluacion'),
			array('proyecto','exist','allowEmpty' => true, 'attributeName' => 'pro_id', 'className' => 'RvProyecto'),
			array('dispositivo','exist','allowEmpty' => true, 'attributeName' => 'dis_id', 'className' => 'Dispositivo'),
			array('empresa','exist','allowEmpty' => true, 'attributeName' => 'emp_id', 'className' => 'Empresa'),
			array('usuario','exist','allowEmpty' => true, 'attributeName' => 'iduser', 'className' => 'CrugeStoredUser'),
			array('inicio,termino','date','format'=>'yyyy-MM-dd'),
			array('limite','default','value'=>100),
			array('order','in','range'=>array('order by t.creado desc','order by t.creado asc','order by t.calificacion desc','order by t.calificacion asc'),'allowEmpty'=>true),
		);
	}
	public function attributeLabels()
	{
		return array(
			'ficha'=>'Ficha',
			'trabajador'=>'Trabajador',
			'evaluacion'=>'Evaluación',
			'inicio'=>'Inicio',
			'termino'=>'Termino',
			'proyecto'=>'Proyecto',
			'limite'=>'Cantidad',
			'dispositivo'=>'Dispositivo',
			'empresa'=>'Empresa',
			'usuario'=>'Usuario',
			'order'=>'Orden',
		);
	}
	public function getDispositivos()
	{
		if($empresa==null){
			return Dispositivo::model()->findAll("EXISTS(SELECT * FROM `empresa_dispositivo` WHERE `empresa_dispositivo`.`dis_id` = `t`.`dis_id` AND `empresa_dispositivo`.`emu_id` = $this->usuario)");
		}
		else{
			return Dispositivo::model()->findAll('t.emp_id='.$this->empresa);
		}
	}
	public function getProyectos()
	{
		if($empresa==null){
			return RvProyecto::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `empresa_dispositivo` ON (`rv_ficha`.`disp_id` = `empresa_dispositivo`.`dis_id`) WHERE `rv_ficha`.`pro_id`=t.`pro_id` AND `empresa_dispositivo`.`emu_id`=$this->usuario)");
		}
		else{
			return RvProyecto::model()->findAll(" EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) WHERE `rv_ficha`.`pro_id` = `t`.`pro_id` AND `dispositivo`.`emp_id`=$this->empresa)");
		}
	}	
	public function getEvaluaciones()
	{
		if($empresa==null){
			return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_dispositivo` ON (`dispositivo`.`dit_id` = `empresa_dispositivo`.`dis_id`)
				WHERE t.`eva_id`=`rv_ficha`.`eva_id` and `empresa_dispositivo`.`emu_id`=$this->usuario)");
		}
		else{
			return RvEvaluacion::model()->findAll(" EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) WHERE `t`.`eva_id` = `rv_ficha`.`eva_id` and `dispositivo`.`emp_id`=$this->empresa)");
		}
	}

	public function getFichas()
	{
		if($empresa==null){
			return Dispositivo::model()->findAll("EXISTS(SELECT * FROM `empresa_dispositivo` WHERE `empresa_dispositivo`.`dis_id` = `t`.`dis_id` AND `empresa_dispositivo`.`emu_id` = $this->usuario)");
		}
		else{
			return Dispositivo::model()->findAll('t.emp_id='.$this->empresa);
		}
	}
// 	SELECT *
// FROM
//   `rv_ficha` `t`
// WHERE
// 	EXISTS(
//     SELECT *
//     FROM 
//     	`trabajador`,
//         `empresa_dispositivo`
//     WHERE
//     	`trabajador`.`tra_id`=t.trab_id AND
//         `trabajador`.`rut` LIKE '14.283.474-K' AND
//         `empresa_dispositivo`.`dis_id`=t.disp_id AND
//         `empresa_dispositivo`.`emu_id`=2
//     ) AND 
//   `t`.`eva_id` = 1 AND 
//   `t`.`disp_id` = 1 AND 
//   `t`.`pro_id` = 1 AND 
//   `t`.`creado` BETWEEN '2016-09-12 00:00' AND '2016-09-13 23:59'
// ORDER BY
//   `t`.`creado` DESC
// LIMIT 100
}