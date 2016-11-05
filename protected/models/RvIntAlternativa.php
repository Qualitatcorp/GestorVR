<?php
class RvIntAlternativa extends CActiveRecord
{
	public function tableName()
	{
		return 'rv_int_alternativa';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function findByLanguage($primary,$language)
	{
		return RvIntAlternativa::model()->find("alt_id=$primary and language='$language'");
	}
}
