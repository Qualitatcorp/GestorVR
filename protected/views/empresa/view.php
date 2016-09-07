<?php
$this->breadcrumbs=array(
	'Empresa',
	$model->nombre,
);

array_push($this->menu, 
	array('label'=>'Editar Empresa', 'url'=>array('update', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Eliminar Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_id),'confirm'=>'¿Estas seguro que deseas eliminar esta empresa?'),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Usuario'),
	array('label'=>'Crear', 'url'=>array('createUsu', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente')),
	array('label'=>'Dispositivo','visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Asignar', 'url'=>array('createDisp', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Licencia','visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Asignar', 'url'=>array('createLic', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Evaluacion'),
	array('label'=>'Ver Fichas', 'url'=>array('adminFicha', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente'))
);
?>
<?php echo BsHtml::pageHeader($model->nombre,'Empresa') ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		// 'emp_id',
		'razon_social',
		'nombre',
		'rut',
		array(
			'name'=>'com_id',
			'value'=>Comuna::model()->findByPk($model->com_id)->com_nombre
			),
		'giro',
		'fono',
		'mail',
		'creado',
		'activa',
	),
));?>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <!-- <li role="presentation" class="active"><a href="#Perfil" aria-controls="Perfil" role="tab" data-toggle="tab">Perfil</a></li> -->
    <li role="presentation" class="active"><a href="#Graficos" aria-controls="Graficos" role="tab" data-toggle="tab">Graficos</a></li>
    <li role="presentation"><a href="#Usuario" aria-controls="Usuario" role="tab" data-toggle="tab">Usuarios</a></li>
    <li role="presentation"><a href="#Licencia" aria-controls="Licencia" role="tab" data-toggle="tab">Licencia</a></li>
    <li role="presentation"><a href="#Dispositivos" aria-controls="Dispositivos" role="tab" data-toggle="tab">Dispositivos</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane fade" id="Perfil"></div>
    <div role="tabpanel" class="tab-pane fade" id="Usuario"><?php $this->renderPartial('usuario/admin', array('model'=>$model->usuarios)); ?></div>
    <div role="tabpanel" class="tab-pane fade" id="Licencia"><?php $this->renderPartial('licencia/admin', array('model'=>$model->licencias)); ?></div>
    <div role="tabpanel" class="tab-pane fade in active" id="Graficos"><?php $this->renderPartial('chart', array('model'=>$model)); ?></div>
   	  <div role="tabpanel" class="tab-pane fade" id="Dispositivos"><?php $this->renderPartial('dispositivo/admin', array('model'=>$model->dispositivos)); ?></div>

  </div>

</div>




