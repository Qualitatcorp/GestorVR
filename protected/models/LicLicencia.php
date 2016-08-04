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
class LicLicencia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lic_licencia';
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lic_id' => 'Lic',
			'emp_id' => 'Emp',
			'lit_id' => 'Lit',
			'descripcion' => 'Descripcion',
			'creado' => 'Creado',
			'modificado' => 'Modificado',
			'cantidad' => 'Cantidad',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
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
			$lic=LicTipo::model()->findByPk($this->lit_id)->cantidad;
		return $this->cantidad*$lic;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
