<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $emp_id
 * @property string $nombre
 * @property string $rut
 * @property integer $com_id
 * @property string $razon_social
 * @property integer $giro
 * @property string $fono
 * @property string $mail
 * @property string $creado
 * @property string $activa
 */
class Empresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, com_id, razon_social, creado', 'required'),
			array('com_id, giro', 'numerical', 'integerOnly'=>true),
			array('rut', 'length', 'max'=>12),
			array('fono', 'length', 'max'=>50),
			array('activa', 'length', 'max'=>2),
			array('mail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_id, nombre, rut, com_id, razon_social, giro, fono, mail, creado, activa', 'safe', 'on'=>'search'),
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
			'emp_id' => 'Emp',
			'nombre' => 'Nombre',
			'rut' => 'Rut',
			'com_id' => 'Com',
			'razon_social' => 'Razon Social',
			'giro' => 'Giro',
			'fono' => 'Fono',
			'mail' => 'Mail',
			'creado' => 'Creado',
			'activa' => 'Activa',
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

		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('com_id',$this->com_id);
		$criteria->compare('razon_social',$this->razon_social,true);
		$criteria->compare('giro',$this->giro);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('activa',$this->activa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
