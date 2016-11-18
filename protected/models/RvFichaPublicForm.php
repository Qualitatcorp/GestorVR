<?php 
/**
* RvFichaPublicForm
*/
class RvFichaPublicForm extends CFormModel
{
	public $number;
	public $language;
	public $type;
	public $captcha;

   public function rules()
   {
      return array(
      	array('number,language,type','required'),
      	array('number','numerical','integerOnly'=>true,'min'=>1),
      	array('language','in','range'=>array_keys(Yii::app()->params['language']),'allowEmpty'=>false),
      	array('type','in','range'=>array('HTML','PDF'),'allowEmpty'=>false),
        array('captcha', 'ext.recaptcha.ReCaptchaValidator'),
      );
   }
 
   public function attributeLabels()
   {
      return array(
      	'number'=>Yii::t('app','Numero de ficha'),
      	'language'=>Yii::t('app','Language'),
      	'type'=>Yii::t('app','Tipo'),
        'captcha'=>Yii::t('app', 'Enter both words separated by a space: '),
      );
   }
   public function getFicha()
   {
   		return RvFicha::model()->findByPk($this->number);
   }
	public function getInternational()
	{
		$ficha=$this->ficha;
		if(empty($ficha)){
			return false;
		}else{
			return $ficha->evaluacion->isInternational;
		}

	}
}