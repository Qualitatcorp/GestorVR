<?php

/**
 * This is the model class for table "rv_alternativa".
 *
 * The followings are the available columns in table 'rv_alternativa':
 * @property string $alt_id
 * @property string $pre_id
 * @property string $alternativa
 * @property integer $descripcion
 * @property integer $ponderacion
 * @property string $correcta
 */
class RvAlternativa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_alternativa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pre_id, alternativa, descripcion, ponderacion, correcta', 'required'),
			array('descripcion, ponderacion', 'numerical', 'integerOnly'=>true),
			array('pre_id, alternativa', 'length', 'max'=>10),
			array('correcta', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('alt_id, pre_id, alternativa, descripcion, ponderacion, correcta', 'safe', 'on'=>'search'),
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
			'alt_id' => 'Alt',
			'pre_id' => 'Pre',
			'alternativa' => 'Alternativa',
			'descripcion' => 'Descripcion',
			'ponderacion' => 'Ponderacion',
			'correcta' => 'Correcta',
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

		$criteria->compare('alt_id',$this->alt_id,true);
		$criteria->compare('pre_id',$this->pre_id,true);
		$criteria->compare('alternativa',$this->alternativa,true);
		$criteria->compare('descripcion',$this->descripcion);
		$criteria->compare('ponderacion',$this->ponderacion);
		$criteria->compare('correcta',$this->correcta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RvAlternativa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
