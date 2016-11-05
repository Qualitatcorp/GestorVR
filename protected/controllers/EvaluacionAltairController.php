<?php

class EvaluacionAltairController extends Controller
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(array('CrugeAccessControlFilter'));
	}

	public function accessRules()
	{
		return array(
			array('accessControl'),
		);
	}

	public function actionAdmin()
	{
		$model=new EvaluacionAltair('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EvaluacionAltair']))
			$model->attributes=$_GET['EvaluacionAltair'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}