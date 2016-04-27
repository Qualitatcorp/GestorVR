<?php

/**
 * This is the model class for table "rv_ficha".
 *
 * The followings are the available columns in table 'rv_ficha':
 * @property string $fic_id
 * @property string $eva_id
 * @property string $trab_id
 * @property integer $emp_id
 * @property string $creado
 */
class RvFicha extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_ficha';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eva_id, trab_id, emp_id, creado', 'required'),
			array('emp_id', 'numerical', 'integerOnly'=>true),
			array('eva_id, trab_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fic_id, eva_id, trab_id, emp_id, creado', 'safe', 'on'=>'search'),
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
			'fic_id' => 'Fic',
			'eva_id' => 'Eva',
			'trab_id' => 'Trab',
			'emp_id' => 'Emp',
			'creado' => 'Creado',
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

		$criteria->compare('fic_id',$this->fic_id,true);
		$criteria->compare('eva_id',$this->eva_id,true);
		$criteria->compare('trab_id',$this->trab_id,true);
		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RvFicha the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
