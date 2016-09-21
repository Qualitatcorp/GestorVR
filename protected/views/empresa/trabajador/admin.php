<?php
/* @var $this TrabajadorController */
/* @var $model Trabajador */


$this->breadcrumbs=array(
	'Trabajador',
	'Administrar',
);

echo BsHtml::pageHeader('Administrar','Trabajadores') ?>
<div class="panel panel-default">
    <div >
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'trabajador-grid',
			'dataProvider'=>$model->search_empresa(),
			'filter'=>$model,
			'columns'=>array(
        		// 'tra_id',
        		'rut',
		'nombre',
		'paterno',
		'materno',
		// 'nacimiento',
		// 'fono',
		
		// 'mail',
		// 'creacion',
		// 'modificado',
		
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>