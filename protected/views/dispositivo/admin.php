<?php $this->breadcrumbs=array('Dispositivos registrados','Administrar');?>
<?php echo BsHtml::pageHeader('Administrar','Dispositivos registrados') ?>
<?php
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
	->registerCssFile($baseUrl.'/css/dataTables.bootstrap.min.css')
	->registerScriptFile($baseUrl.'/js/jquery.dataTables.min.js',CClientScript::POS_END)
	->registerScriptFile($baseUrl.'/js/dataTables.bootstrap.min.js',CClientScript::POS_END)
	->registerScript('dataTables', "$('.table').DataTable({
        'language': {
			    \"sProcessing\":     \"Procesando...\",
			    \"sLengthMenu\":     \"Mostrar _MENU_ registros\",
			    \"sZeroRecords\":    \"No se encontraron resultados\",
			    \"sEmptyTable\":     \"Ningún dato disponible en esta tabla\",
			    \"sInfo\":           \"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros\",
			    \"sInfoEmpty\":      \"Mostrando registros del 0 al 0 de un total de 0 registros\",
			    \"sInfoFiltered\":   \"(filtrado de un total de _MAX_ registros)\",
			    \"sInfoPostFix\":    \"\",
			    \"sSearch\":         \"Buscar:\",
			    \"sUrl\":            \"\",
			    \"sInfoThousands\":  \",\",
			    \"sLoadingRecords\": \"Cargando...\",
			    \"oPaginate\": {
			        \"sFirst\":    \"Primero\",
			        \"sLast\":     \"Último\",
			        \"sNext\":     \"Siguiente\",
			        \"sPrevious\": \"Anterior\"
			    },
			    \"oAria\": {
			        \"sSortAscending\":  \": Activar para ordenar la columna de manera ascendente\",
			        \"sSortDescending\": \": Activar para ordenar la columna de manera descendente\"
			    }
		}
	})", CClientScript::POS_READY);
?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th>Nombre</th>
			<th style="width:50px">Descripción</th>
			<th style="width:215px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($List as $key=>$model): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $model->nombre ?></td>
			<td><?php echo $model->empresa ?></td>
			<td>
				<?= BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Ver', array(
				    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
				    'size' => BsHtml::BUTTON_SIZE_SMALL,
					'onclick'=>"window.location.href='viewTipo/$model->dis_id'",
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
								'onclick'=>"window.location.href='deleteDisp/$model->dis_id'",
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
					'onclick'=>"window.location.href='editDisp/$model->dis_id'",
				));?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
