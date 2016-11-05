<?php 
/**
* Reportes
*/

class Excel extends CFormModel
{
	public $excel;
	public $page;
	public $file;

	public function rules()
	{
		return array(
			array('file', 'file', 'types'=>'xls,xlsx'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'file' => 'Excel',
		);
	}



	public function add($title,$data,$Sheet=-1,$cell='A1')
	{
		if($Sheet!=-1){
			$this->excel->createSheet ($Sheet);
			$this->excel->setActiveSheetIndex($Sheet);
		}else{
			if($this->page!=1){
				$this->excel->createSheet ();
				$this->excel->setActiveSheetIndex($this->page-1);
			}
		}
		$this->excel->getActiveSheet()->setTitle($title);
		$this->excel->getActiveSheet()
		    ->fromArray(
		        $data,
		        NULL,      
		        $cell        
		    );
		$this->page++;

	}	
	public function addModel($title,$headers,$data,$Sheet=-1,$cell='A1')
	{
		$this->add($title,$this->parseArray($headers,$data),$Sheet,$cell);
	}

	public function out($title='Informe',$autosize=false)
	{
		if($autosize){
			for ($i = 'A'; $i !=  $this->excel->getActiveSheet()->getHighestColumn(); $i++) {
			    $this->excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$title.'.xls"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	public function parseArray($headers,$model)
	{
		$head=true;
		$list=array();
		foreach ($model as $m) {
			if($head){
				$element=array();
				foreach ($headers as $attribute) {
					$element[]=$m->getAttributeLabel($attribute);
				}
				$list[]=$element;
				$head=false;
			}
			$element=array();
			foreach ($headers as $attribute) {
				$element[]=$m->$attribute;
			}
			$list[]=$element;
		}
		return $list;
	}

	public function load($dir)
	{
		$this->file = PHPExcel_IOFactory::load($dir);
		return $this->file->getActiveSheet()->toArray(null, true, false, false);
	}


   	public function __construct() {
		parent::__construct();	    
		Yii::import('ext.phpexcel.XPHPExcel');      
		$this->excel = XPHPExcel::createPHPExcel();
		$this->excel->getProperties()->setCreator("Qualitatcorp")
									 ->setLastModifiedBy("Qualitatcorp")
									 ->setTitle("")
									 ->setSubject("")
									 ->setDescription("")
									 ->setKeywords("")
									 ->setCategory("");
		$this->page=1;
	}

}