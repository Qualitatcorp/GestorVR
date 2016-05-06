<?php

/**
 * This is the model class for table "rv_evaluacion".
 *
 * The followings are the available columns in table 'rv_evaluacion':
 * @property string $eva_id
 * @property integer $tev_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $creado
 * @property string $habilitado
 */
class RvEvaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rv_evaluacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tev_id, nombre,', 'required'),
			array('tev_id', 'numerical', 'integerOnly'=>true),
			array('habilitado', 'length', 'max'=>2),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eva_id, tev_id, nombre, descripcion, creado, habilitado', 'safe', 'on'=>'search'),
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
			'eva_id' => 'Evaluación',
			'tev_id' => 'Tipo evaluación',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripción',
			'creado' => 'Creado',
			'habilitado' => 'Habilitado',
		);
	}
	public function getTipoNombre()
	{
		return RvTipo::model()->findByPk($this->tev_id)->nombre;
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('eva_id',$this->eva_id,true);
		$criteria->compare('tev_id',$this->tev_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('habilitado',$this->habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
