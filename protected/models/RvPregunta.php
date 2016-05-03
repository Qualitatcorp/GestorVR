<?php

/**
 * This is the model class for table "rv_pregunta".
 *
 * The followings are the available columns in table 'rv_pregunta':
 * @property string $pre_id
 * @property string $eva_id
 * @property string $descripcion
 * @property string $comentario
 * @property string $imagen
 * @property string $creado
 * @property string $modificado
 * @property string $habilitado
 */
class RvPregunta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_pregunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eva_id, descripcion, creado, habilitado', 'required'),
			array('eva_id', 'length', 'max'=>10),
			array('habilitado', 'length', 'max'=>2),
			array('comentario, imagen, modificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pre_id, eva_id, descripcion, comentario, imagen, creado, modificado, habilitado', 'safe', 'on'=>'search'),
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
			'pre_id' => 'Pre',
			'eva_id' => 'Eva',
			'descripcion' => 'Descripcion',
			'comentario' => 'Comentario',
			'imagen' => 'Imagen',
			'creado' => 'Creado',
			'modificado' => 'Modificado',
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

		$criteria->compare('pre_id',$this->pre_id,true);
		$criteria->compare('eva_id',$this->eva_id,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('imagen',$this->imagen,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('modificado',$this->modificado,true);
		$criteria->compare('habilitado',$this->habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RvPregunta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
