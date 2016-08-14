<?php

/**
 * This is the model class for table "usuario_empresa".
 *
 * The followings are the available columns in table 'usuario_empresa':
 * @property string $use_id
 * @property string $emp_id
 * @property string $usu_id
 */
class UsuEmpresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_id, usu_id', 'required'),
			array('emp_id, usu_id', 'length', 'max'=>10),
			array('use_id, emp_id, usu_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user0' => array(self::BELONGS_TO, 'CrugeStoredUser', 'usu_id'),
			'Empresa0' => array(self::BELONGS_TO, 'Empresa', 'emp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'use_id' => 'Use',
			'emp_id' => 'Emp',
			'usu_id' => 'Usu',
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

		$criteria->compare('use_id',$this->use_id,true);
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('usu_id',$this->usu_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuEmpresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
