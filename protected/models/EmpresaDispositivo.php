<?php

/**
 * This is the model class for table "empresa_dispositivo".
 *
 * The followings are the available columns in table 'empresa_dispositivo':
 * @property string $emd_id
 * @property string $dis_id
 * @property string $emu_id
 *
 * The followings are the available model relations:
 * @property EmpresaUsuario $emu
 * @property Dispositivo $dis
 */
class EmpresaDispositivo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa_dispositivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dis_id, emu_id', 'required'),
			array('dis_id', 'length', 'max'=>10),
			array('emu_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emd_id, dis_id, emu_id', 'safe', 'on'=>'search'),
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
			'emu' => array(self::BELONGS_TO, 'EmpresaUsuario', 'emu_id'),
			'dis' => array(self::BELONGS_TO, 'Dispositivo', 'dis_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'emd_id' => 'Emd',
			'dis_id' => 'Dis',
			'emu_id' => 'Emu',
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

		$criteria->compare('emd_id',$this->emd_id,true);
		$criteria->compare('dis_id',$this->dis_id,true);
		$criteria->compare('emu_id',$this->emu_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpresaDispositivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
