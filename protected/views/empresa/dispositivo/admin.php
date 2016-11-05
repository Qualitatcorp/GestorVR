<?php if ($model!=null): ?>
<?php echo BsHtml::pageHeader('Dispositivos registrados') ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th style="width:20px">ID</th>
			<th>Nombre</th>
			<th style="width:200px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($model as $key=>$data): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?=$data->primaryKey ?></td>
			<td><?php echo $data->alternativo ?></td>
			<td>
				<?php
					#modal de eliminar
					echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_TRASH).' Eliminar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
					    'data-target'=>'#EliminarDis'.$key,
					    'data-toggle'=>'modal'
					));
					$this->widget('bootstrap.widgets.BsModal', array(
					    'id' => 'EliminarDis'.$key,
					    'header' => "¿Desea eliminar a '$data->nombre' ?",
					    'content' => "<p>Se quitara de la lista $data->nombre</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
								'onclick'=>"window.location.href='deleteDisp/$data->dis_id'",
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
					'onclick'=>"window.location.href='editDisp/$data->dis_id'",
				));?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>