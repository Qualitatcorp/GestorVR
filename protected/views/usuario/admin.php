<?php
$this->breadcrumbs=array(
	'Usuario',
	'Administrar',
);
$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Usuario', 'url'=>array('create')),
);

?>
<?= BsHtml::pageHeader('Administración', 'Usuarios') ?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'user-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'iduser',
		// 'regdate',
		// 'actdate',
		// 'logondate',
		'username',
		'email',
		'empresa',
		/*
		'password',
		'authkey',
		'state',
		'totalsessioncounter',
		'currentsessioncounter',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>