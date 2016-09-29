<?php
$this->breadcrumbs=array(
	Yii::t('Navbar','Empresa'),
	$model->nombre,
);

array_push($this->menu, 
	array('label'=>Yii::t('Navbar','Editar'), 'url'=>array('update', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Eliminar'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_id),'confirm'=>Yii::t('Navbar','¿Estas seguro que deseas eliminar esta empresa?')),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Usuario')),
	array('label'=>Yii::t('Navbar','Crear'), 'url'=>array('createUsu', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente')||Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Dispositivo'),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Asignar'), 'url'=>array('createDisp', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Licencia'),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Asignar'), 'url'=>array('createLic', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('Navbar','Evaluacion')),
	array('label'=>Yii::t('Navbar','Ver Fichas'), 'url'=>array('adminFicha', 'id'=>$model->emp_id),'visible'=>Yii::app()->user->checkAccess('Cliente'))
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
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#Graficos" aria-controls="Graficos" role="tab" data-toggle="tab"><?=Yii::t('Navbar','Graficos')?></a></li>
    <li role="presentation"><a href="#Usuario" aria-controls="Usuario" role="tab" data-toggle="tab"><?=Yii::t('Navbar','Usuarios')?></a></li>
    <li role="presentation"><a href="#Licencia" aria-controls="Licencia" role="tab" data-toggle="tab"><?=Yii::t('Navbar','Licencia')?></a></li>
    <li role="presentation"><a href="#Dispositivos" aria-controls="Dispositivos" role="tab" data-toggle="tab"><?=Yii::t('Navbar','Dispositivos')?></a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade" id="Usuario"><?php $this->renderPartial('usuario/admin', array('model'=>$model->usuarios)); ?></div>
    <div role="tabpanel" class="tab-pane fade" id="Licencia"><?php $this->renderPartial('licencia/admin', array('model'=>$model->licencias)); ?></div>
    <div role="tabpanel" class="tab-pane fade in active" id="Graficos"><?php $this->renderPartial('chart', array('model'=>$model)); ?></div>
   	  <div role="tabpanel" class="tab-pane fade" id="Dispositivos"><?php $this->renderPartial('dispositivo/admin', array('model'=>$model->dispositivos));?></div>
  </div>
</div>




