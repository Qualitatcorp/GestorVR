<?php 
$list=RvFicha::model()->findAll("t.trab_id=$model->primaryKey ORDER BY t.creado");

var_dump($list);
 ?>