<?php

/**
 * This is the model class for table "lic_registro".
 *
 * The followings are the available columns in table 'lic_registro':
 * @property integer $lig_id
 * @property integer $lic_id
 * @property integer $iduser
 * @property integer $cantidad
 * @property string $tipo
 * @property integer $descripcion
 * @property string $habilitado
 */
class LicenciaRegistro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'licencia_registro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lic_id, iduser, descripcion', 'required'),
			array('lic_id, iduser, cantidad', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>5),
			array('habilitado', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lig_id, lic_id, iduser, cantidad, tipo, descripcion, habilitado', 'safe', 'on'=>'search'),
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
			'lig_id' => 'Lig',
			'lic_id' => 'Lic',
			'iduser' => 'Iduser',
			'cantidad' => 'Cantidad',
			'tipo' => 'Tipo',
			'descripcion' => 'Descripcion',
			'habilitado' => 'Habilitado',
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

		$criteria->compare('lig_id',$this->lig_id);
		$criteria->compare('lic_id',$this->lic_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('descripcion',$this->descripcion);
		$criteria->compare('habilitado',$this->habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LicRegistro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
