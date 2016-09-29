<?php
class RvPregunta extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_pregunta';
	}

	public function rules()
	{
		return array(
			array('eva_id, descripcion, habilitado', 'required'),
			array('eva_id', 'length', 'max'=>10),
			array('habilitado', 'length', 'max'=>2),
			array('comentario, imagen, modificado', 'safe'),
			array('imagen', 'file', 'types'=>'jpg,png','on'=>'insert'),
			// array('imagen', 'file','allowEmpty'=>true, 'types'=>'jpg,png'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pre_id, eva_id, descripcion, comentario, imagen, creado, modificado, habilitado', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(			
			'alternativas' => array(self::HAS_MANY, 'RvAlternativa', 'pre_id'),
			'evaluacion' => array(self::BELONGS_TO, 'RvEvaluacion', 'eva_id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'pre_id' => 'Pre',
			'eva_id' => 'Eva',
			'descripcion' => 'Pregunta',
			'comentario' => 'Comentario',
			'imagen' => 'Imagen',
			'creado' => 'Creado',
			'modificado' => 'Modificado',
			'habilitado' => 'Habilitado',
		);
	}
	public function getActive()
	{
		return ($this->habilitado=='SI')?true:false;
	}
	public function getUrlImagen()
	{
		// if()
		// return Yii::app()->request->baseUrl.'/images/rv/SIN IMAGEN.png';
		return Yii::app()->request->baseUrl.'/images/rv/'.(($this->imagen=='')?"/SIN IMAGEN.png":"$this->pre_id-$this->imagen");
	}
	public function language()
	{

		return $this;
	}
	public function getRenderImagen()
	{
		return BsHtml::imageThumbnail($this->UrlImagen,'pregunta',array('height'=>'120px','width'=>'120px'));
	}
	public function search()
	{

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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
