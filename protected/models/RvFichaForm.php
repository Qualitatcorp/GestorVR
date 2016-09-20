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

	public $activo=false;
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
			array('order','in','range'=>array('t.creado desc','t.creado asc','t.calificacion desc','t.calificacion asc'),'allowEmpty'=>true),
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
		if(!empty($this->empresa)){
				return Dispositivo::model()->findAll('t.emp_id='.$this->empresa);
		}
		else{
			if(!empty($this->usuario)){
			return Dispositivo::model()->findAll("EXISTS(SELECT * FROM `empresa_dispositivo` WHERE `empresa_dispositivo`.`dis_id` = `t`.`dis_id` AND `empresa_dispositivo`.`emu_id` = $this->usuario)");
			}else{
				return Dispositivo::model()->findAll();
			}
		}
	}
	public function getProyectos()
	{
		if(!empty($this->empresa)){
			return RvProyecto::model()->findAll(" EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) WHERE `rv_ficha`.`pro_id` = `t`.`pro_id` AND `dispositivo`.`emp_id`=$this->empresa)");
		}
		else{
			if(!empty($this->usuario)){
			return RvProyecto::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `empresa_dispositivo` ON (`rv_ficha`.`disp_id` = `empresa_dispositivo`.`dis_id`) WHERE `rv_ficha`.`pro_id`=t.`pro_id` AND `empresa_dispositivo`.`emu_id`=$this->usuario)");
			}else{
				return RvProyecto::model()->findAll();
			}
		}
	}	
	public function getEvaluaciones()
	{
		if(!empty($this->empresa)){
			return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) WHERE `t`.`eva_id` = `rv_ficha`.`eva_id` and `dispositivo`.`emp_id`=$this->empresa)");
		}
		else{
			if(!empty($this->usuario)){
			return RvEvaluacion::model()->findAll("EXISTS(SELECT * FROM `rv_ficha` INNER JOIN `dispositivo` ON (`rv_ficha`.`disp_id` = `dispositivo`.`dis_id`) INNER JOIN `empresa_dispositivo` ON (`dispositivo`.`dit_id` = `empresa_dispositivo`.`dis_id`)
				WHERE t.`eva_id`=`rv_ficha`.`eva_id` and `empresa_dispositivo`.`emu_id`=$this->usuario)");
			}else{
				return RvEvaluacion::model()->findAll();
			}
		}
	}
	public function getExcel()
	{			
		$this->limite=null;
		
		$model=RvFicha::model()->findAll($this->fichas);
		if(!empty($model)){
			$list=array();
			$list[]=array('#','Ficha','Trabajador','RUT','Evaluacion','Calificacion','Fecha','Dispositivo');
			foreach ($model as $key => $value) {
				$list[]=array(
					$key+1,
					$value->primaryKey,
					$value->trabajador->nombreCompleto,
					$value->trabajador->rut,
					$value->evaluacion->nombre,
					$value->nota,
					$value->creado,
					$value->dispositivo->alternativo
					);
			}

			$e=new Excel;
			$e->add('Fichas de Evaluacion',$list);
			$e->out('Fichas de Evaluacion',true);
		}


		// $e->addModel('Trabajadores',array('rut','nombre','paterno','materno'/*,'nacimiento','fono','mail'*/),$model);
		// $e->out('trabajadores',true);
	}
	public function getFichas()
	{
		//Reslueve segundo nivel de busqueda
		$EXISTS=array();
		if(!empty($this->trabajador)){
			$EXISTS['FROM'][]="`trabajador`";
			$EXISTS['WHERE'][]="`trabajador`.`tra_id`=t.trab_id AND `trabajador`.`rut` LIKE '$this->trabajador'";
		}
		if(!empty($this->usuario)){
			$EXISTS['FROM'][]="`empresa_dispositivo`";
			$EXISTS['WHERE'][]="`empresa_dispositivo`.`dis_id`=t.disp_id AND `empresa_dispositivo`.`emu_id`=$this->usuario";
		}
		// //Define primer nivel de busqueda
		$WHERE=array();
		if(!empty($EXISTS)){
			$WHERE[]="EXISTS(SELECT * FROM ".implode(",", $EXISTS['FROM'])." WHERE ".implode(" AND ", $EXISTS['WHERE']).")";
		}
		if(!empty($this->ficha)){
			$WHERE[]="`t`.`fic_id` = $this->ficha";
		}
		if(!empty($this->evaluacion)){
			$WHERE[]="`t`.`eva_id` =$this->evaluacion";
		}
		if(!empty($this->dispositivo)){
			$WHERE[]="`t`.`disp_id` = $this->dispositivo";
		}		
		if(!empty($this->proyecto)){
			$WHERE[]="`t`.`pro_id` = $this->proyecto";
		}
		if(!empty($this->inicio)&&!empty($this->termino)){
			$WHERE[]="`t`.`creado` BETWEEN '$this->inicio 00:00' AND '$this->termino 23:59'";
		}else{
			if(!empty($this->inicio)){
				$WHERE[]="`t`.`creado` > '$this->inicio 00:00'";
			}			
			if(!empty($this->termino)){
				$WHERE[]="`t`.`creado` < '$this->termino 23:59'";
			}
		}
		$SQL="";
		// //PostFiltro de Busqueda
		if(!empty($WHERE)){
			$SQL.=implode(" AND ", $WHERE);
		}
		if(!empty($this->order)){
			$SQL.=" order by $this->order";
		}		
		if(!empty($this->limite)){
			$SQL.=" LIMIT $this->limite";
		}
		return $SQL;
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