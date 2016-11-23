<?php $this->breadcrumbs=array('Tipo de Licencia','Administrar');?>
<?php echo BsHtml::pageHeader('Administrar','Tipo de Licencia') ?>
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
?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th style="width:50px">Cantidad</th>
			<th style="width:50px">Disponible</th>
			<th style="width:215px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($List as $key=>$model): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $model->nombre ?></td>
			<td><?php echo $model->descripcion ?></td>
			<td><?php echo $model->cantidad ?></td>
			<td><?php echo $model->disponible ?></td>
			<td>
				<?= BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Ver', array(
				    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
				    'size' => BsHtml::BUTTON_SIZE_SMALL,
					'onclick'=>"window.location.href='viewTipo/$model->lit_id'",
				));?>
				<?php
					#modal de eliminar
					echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_TRASH).' Eliminar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
					    'data-target'=>'#Eliminar'.$key,
					    'data-toggle'=>'modal'
					));
					$this->widget('bootstrap.widgets.BsModal', array(
					    'id' => 'Eliminar'.$key,
					    'header' => "¿Desea eliminar a '$model->nombre' ?",
					    'content' => "<p>Se quitara de la lista $model->nombre</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
								'onclick'=>"window.location.href='deleteTipo/$model->lit_id'",
							    'color' => BsHtml::BUTTON_COLOR_PRIMARY
							)),
					        BsHtml::button('Cancelar', array(
					            'data-dismiss' => 'modal'
					        )),

					    )
					));
				?>
				<?= BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Modificar', array(
				    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
				    'size' => BsHtml::BUTTON_SIZE_SMALL,
					'onclick'=>"window.location.href='updateTipo/$model->lit_id'",
				));?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
