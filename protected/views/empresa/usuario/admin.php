<?php if ($model!=null): ?>
<?php echo BsHtml::pageHeader('Usuarios') ?>
<table class="table">
	<thead>
		<th style="width:20px">#</th>
		<th>RUT</th>
		<th>Nombre</th>
		<th style="width:200px">Opciones</th>
	</thead>
	<tbody>
		<?php foreach ($model as $key=>$data): ?>
			<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $data->RUT ?></td>
				<td><?php echo $data->nombreCompleto ?></td>
				<td>
					<?php
						#trigger modal
						echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_TRASH).' Eliminar', array(
						    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
						    'size' => BsHtml::BUTTON_SIZE_SMALL,
						    'data-target'=>'#EliminarUsu'.$key,
						    'data-toggle'=>'modal'
						));
						#Creador de Modal
						$this->widget('bootstrap.widgets.BsModal', array(
						    'id' => 'EliminarUsu'.$key,
						    'header' => "¿Desea eliminar a '$data->nombreCompleto' ?",
						    'content' => "<p>Se quitara de la lista $data->nombreCompleto</p>",
						    'footer' => array(
						        BsHtml::Button('Eliminar de todos modos', array(
									'onclick'=>"window.location.href='deleteUsu/$data->emu_id'",
								    'color' => BsHtml::BUTTON_COLOR_PRIMARY
								)),
						        BsHtml::button('Cancelar', array(
						            'data-dismiss' => 'modal'
						        )),
						    )
						));
						#Fin Modal
						echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Modificar', array(
						    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
						    'size' => BsHtml::BUTTON_SIZE_SMALL,
							'onclick'=>"window.location.href='updateUsu/$data->emu_id'",
						));
					?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>