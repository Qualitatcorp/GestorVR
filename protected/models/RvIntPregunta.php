<?php
class RvIntPregunta extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_int_pregunta';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function findByLanguage($primary,$language)
	{
		return RvIntPregunta::model()->find("pre_id=$primary and language='$language'");
	}
}

