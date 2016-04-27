<?php $this->breadcrumbs=array(
	'Empresas',
	'Manage',
);?>

<?php echo BsHtml::pageHeader('Administrar','Empresas') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p>
            Puedes opcionalmente ingresar operadores de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>)
        </p>
    </div>
    <div class="panel-body">


        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'empresa-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
    		// 'emp_id',
			'nombre',
			'rut',
			// 'com_id',
			// 'razon_social',
			// 'giro',
			// 'fono',
			// 'mail',
			// 'creado',
			'activa',
			array(
				'class'=>'bootstrap.widgets.BsButtonColumn',
			),
			),
        )); ?>
    </div>
</div>




