<?php

/**
 * This is the model class for table "rv_int_alternativa".
 *
 * The followings are the available columns in table 'rv_int_alternativa':
 * @property string $int_id
 * @property string $alt_id
 * @property string $language
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property RvAlternativa $alt
 */
class RvIntAlternativa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_int_alternativa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alt_id, language, descripcion', 'required'),
			array('alt_id', 'length', 'max'=>10),
			array('language', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('int_id, alt_id, language, descripcion', 'safe', 'on'=>'search'),
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
			'alternativa' => array(self::BELONGS_TO, 'RvAlternativa', 'alt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'int_id' => 'Int',
			'alt_id' => 'Alt',
			'language' => 'Language',
			'descripcion' => 'Descripcion',
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

		$criteria->compare('int_id',$this->int_id,true);
		$criteria->compare('alt_id',$this->alt_id,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RvIntAlternativa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
