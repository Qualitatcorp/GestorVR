<?php
class RvIntEvaluacion extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_int_evaluacion';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function findByLanguage($primary,$language)
	{
		return RvIntEvaluacion::model()->find("eva_id=$primary and language='$language'");
	}
}
