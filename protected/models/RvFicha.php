<?php
class RvFicha extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_ficha';
	}
	public function rules()
	{
		return array(
			array('trab_id,disp_id', 'required'),
			array('trab_id,disp_id', 'length', 'max'=>10),
			array('fic_id, trab_id, disp_id,creado', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
			'respuestas' => array(self::HAS_MANY, 'RvRespuesta', 'fic_id'),
			'trabajador' => array(self::BELONGS_TO, 'Trabajador', 'trab_id'),
			'dispositivo' => array(self::BELONGS_TO, 'Dispositivo', 'disp_id'),
			'evaluacion' => array(self::BELONGS_TO, 'RvEvaluacion', 'eva_id'),
			'RvProyecto' => array(self::BELONGS_TO, 'RvProyecto', 'pro_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'fic_id' => 'Ficha',
			'trab_id' => 'Trabajador',
			'disp_id' => 'Dispositivo',
			'creado' => 'Creado',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('fic_id',$this->fic_id,true);
		$criteria->compare('trab_id',$this->trab_id,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNota($clasificacion=null)
	{
		if($this->calificacion===null){
			$this->calificacion=$this->porcentajeCorrecto;
			$this->save();
			echo '*';
		}
		return $this->MapNota($this->calificacion,$clasificacion);
	}
	public function getNameClasificacion()
	{
			return (($model=EmpresaUsuario::findByID())!==null)?$model->clasificacion:'Sobre 100';
	}
	public function MapNota($value,$tipo=null)
	{
		if($tipo===null)
			$tipo=RvFicha::getNameClasificacion();
		switch ($tipo) {
			case 'Sobre 100':
				return number_format(100*$value);
				break;			
			case 'Sobre 20':
				return number_format(20*$value);
				break;			
			case 'Sobre 10':
				return number_format(10*$value,1);
				break;			
			case 'Sobre 7':
				return number_format(1+6*$value,1);
				break;			
			case 'Sobre 6':
				return number_format(1+5*$value,1);
				break;			
			case 'Sobre 5':
				return number_format(1+4*$value,1);
				break;
			case 'Letras':
				if ($value>0.5) 
					if ($value>0.75) 
						if ($value>0.9) 
							if ($value>0.95) 
								return 'A++';
							 else 
								return 'A++';
						 else 
							if ($value>0.85) 
								return 'A';
							 else 
								if ($value>8) 
									return 'A-';
								 else 
									return 'B+';	
					 else 
						if ($value>0.65) 
							if ($value>0.7) 
								return 'B';
							 else 
								return 'B-';
						 else 
							if ($value>0.6) 
								return 'C+';
							 else 
								if ($value>0.55) 
									return 'C';
								 else 
									return 'C-';
				 else 
					if ($value>0.25) 
						if ($value>0.35) 
							if ($value>0.45) 
								return 'D+';
							 else 
								if ($value>0.40) 
									return 'D';
								 else 
									return 'D-';
						 else 
							if ($value>0.3) 
								return 'E+';
							 else 
								return 'E';
					 else 
						if($value>0.2)
							return 'E-';
						else
							if ($value>15) 
								return 'F+';
							 else 
								if ($value>0.5) 
									return 'F';
								 else {
									return 'F-';					
				}
			default:
				return $value;
				break;
		}
	}
	public function getPorcentajeCorrecto()
	{
		$total=0;
		$suma=0;
		foreach ($this->respuestas as $resp) {
			$alt=$resp->alternativa;
			if($alt->pregunta->active){
				$total+=$alt->ponderacion;
				if($alt->correcta=='SI')
					$suma+=$alt->ponderacion;
			}
		}
		return ($total!=0)?$suma/$total:null;
	}

	public function SaveNota()
	{
		$this->nota=$this->porcentajeCorrecto;
		$this->save();
	}
	public function findAllByEmpresa($id,$condition='')
	{	
		if(Yii::app()->user->checkAccess('Supervisor')){
			return RvFicha::model()->findAll("Exists(Select * From empresa_dispositivo Inner join dispositivo On (empresa_dispositivo.dis_id = dispositivo.dis_id) Inner join empresa_usuario On (empresa_dispositivo.emu_id = empresa_usuario.emu_id) Where dispositivo.dis_id = t.disp_id and empresa_usuario.usu_id=".Yii::app()->user->getId().") $condition");
		}else{
			return RvFicha::model()->findAll("EXISTS(SELECT * FROM dispositivo INNER JOIN empresa ON (dispositivo.emp_id = empresa.emp_id) WHERE t.disp_id = dispositivo.dis_id AND empresa.emp_id = $id) $condition");
		}
	}
	public function CountByEmpresa($id,$value='')
	{
if($value!==''){
	$value="AND $value";
}
		$query="SELECT 
  YEAR(rv_ficha.creado) As YEAR,
  MONTH(rv_ficha.creado) As MONTH,
  COUNT(*) As DATA
FROM
  rv_ficha
  Inner join dispositivo On (rv_ficha.disp_id = dispositivo.dis_id)
WHERE
  dispositivo.emp_id = $id $value
GROUP BY
  Year(rv_ficha.creado),
  MONTH(rv_ficha.creado)
		";
		return Yii::app()->db->createCommand($query)->queryAll();
	}


public function AvgByEmpresa($id)
	{
		return Yii::app()->db->createCommand("
SELECT 
  YEAR(rv_ficha.creado) as YEAR,
  MONTH(rv_ficha.creado) as MONTH,
  AVG(rv_ficha.calificacion) AS DATA
FROM
  dispositivo
  INNER JOIN rv_ficha ON (dispositivo.dis_id = rv_ficha.disp_id)
WHERE
  dispositivo.emp_id = $id
GROUP BY
  YEAR(rv_ficha.creado),
  MONTH(rv_ficha.creado)
 ")->queryAll();
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
