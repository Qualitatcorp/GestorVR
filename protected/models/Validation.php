<?php 
/**
* Validation
*/
class Validation
{
	public static function strToMonth($month){
		if(Yii::app()->language==='es'){
			switch ($month) {
				case 1:
					return 'Enero';
					break;
				case 2:
					return 'Febrero';
					break;
				case 3:
					return 'Marzo';
					break;
				case 4:
					return 'Abril';
					break;
				case 5:
					return 'Mayo';
					break;
				case 6:
					return 'Junio';
					break;
				case 7:
					return 'Julio';
					break;
				case 8:
					return 'Agosto';
					break;
				case 9:
					return 'Septiembre';
					break;
				case 10:
					return 'Octubre';
					break;
				case 11:
					return 'Noviembre';
					break;
				case 12:
					return 'Diciembre';
					break;
				default:
					return 'Error';
					break;
			}
		}
	}
	// function __construct(argument)
	// {
	// 	# code...
	// }
}