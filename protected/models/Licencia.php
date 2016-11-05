<?php

class Licencia extends CActiveRecord
{
	public function tableName()
	{
		return 'licencia';
	}

	public function rules()
	{
		return array(
			array('emp_id, descripcion, creado', 'required'),
			array('emp_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('lit_id', 'length', 'max'=>10),
			array('modificado', 'safe'),
			array('lic_id, emp_id, lit_id, descripcion, creado, modificado, cantidad', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'emp' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
			'tipo' => array(self::BELONGS_TO, 'LicenciaTipo', 'lit_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'lic_id' => 'Licencia',
			'emp_id' => 'Empresa',
			'lit_id' => 'Licencia',
			'descripcion' => 'Descripcion',
			'creado' => 'Creado',
			'modificado' => 'Modificado',
			'cantidad' => 'Cantidad',
			'nombre'=>'Licencia'
		);
	}
	public function getNombre()
	{

		if($this->tipo!=null){
			return $this->tipo->nombre;
		}
		return '-';
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('lic_id',$this->lic_id);
		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('lit_id',$this->lit_id,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('modificado',$this->modificado,true);
		$criteria->compare('cantidad',$this->cantidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getCantidadTotal()
	{
		$lic=1;
		if($this->lit_id!='')
			$lic=LicenciaTipo::model()->findByPk($this->lit_id)->cantidad;
		return $this->cantidad*$lic;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
