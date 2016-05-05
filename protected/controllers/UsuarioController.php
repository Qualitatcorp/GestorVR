<?php

class UsuarioController extends Controller
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

	/**
			Usuario
	*/


	public function actionView($id)
	{
	}

	public function actionCreate()
	{
	}

	public function actionUpdate()
	{
	}

	public function actionDeleted()
	{
	}

	public function actionAdmin()
	{
	}
}