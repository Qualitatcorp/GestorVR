<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
	->registerCssFile($baseUrl.'/css/dataTables.bootstrap.min.css')
	->registerScriptFile($baseUrl.'/js/jquery.dataTables.min.js',CClientScript::POS_END)
	->registerScriptFile($baseUrl.'/js/dataTables.bootstrap.min.js',CClientScript::POS_END)
	->registerScript('dataTables', "$('.table').DataTable({
        'language': {
			'url': '".Yii::app()->createUrl('js/i18n/datatable/'.Yii::app()->Language.'.json')."'
		}
	})", CClientScript::POS_READY);

$this->breadcrumbs=array(
	'Usuario',
	'Administrar',
);
$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Usuario', 'url'=>array('create')),
);

?>
<?= BsHtml::pageHeader('Administración', 'Usuarios') ?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th>RUT</th>
			<th>Nombre</th>
			<th>Fono</th>
			<th>Email</th>
			<th>Cargo</th>
			<th>Empresa</th>
			<th style="width:160px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($List as $key=>$model): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $model['usu_rut'] ?></td>
			<td><?php echo $model['usu_nombre'] ?></td>
			<td><?php echo $model['usu_fono'] ?></td>
			<td><?php echo $model['usu_email'] ?></td>
			<td><?php echo $model['car_nombre'] ?></td>
			<td><?php echo $model['emp_nombre'] ?></td>
			<td>
				<?php
					echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_TRASH).' Eliminar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
					    'data-target'=>'#Eliminar'.$key,
					    'data-toggle'=>'modal'
					));
					$this->widget('bootstrap.widgets.BsModal', array(
					    'id' => 'Eliminar'.$key,
					    'header' => "¿Desea eliminar a '".$model['usu_nombre']."' ?",
					    'content' => "<p>Se quitara de la lista ".$model['usu_nombre']."</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
								'onclick'=>"window.location.href='delete?rut=".$model['usu_rut']."'",
							    'color' => BsHtml::BUTTON_COLOR_PRIMARY
							)),
					        BsHtml::button('Cancelar', array(
					            'data-dismiss' => 'modal'
					        )),

					    )
					));

					?>
					<?php
					echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Modificar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
						'onclick'=>"window.location.href='update?rut=".$model['usu_rut']."'",
					));
				?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>