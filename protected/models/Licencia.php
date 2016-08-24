<?php

/**
 * This is the model class for table "lic_licencia".
 *
 * The followings are the available columns in table 'lic_licencia':
 * @property integer $lic_id
 * @property integer $emp_id
 * @property string $lit_id
 * @property string $descripcion
 * @property string $creado
 * @property string $modificado
 * @property integer $cantidad
 */
class Licencia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'licencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_id, descripcion, creado', 'required'),
			array('emp_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('lit_id', 'length', 'max'=>10),
			array('modificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lic_id, emp_id, lit_id, descripcion, creado, modificado, cantidad', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'emp' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
			'tipo' => array(self::BELONGS_TO, 'LicenciaTipo', 'lit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
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
		// @todo Please modify the following code to remove attributes that should not be searched.

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
