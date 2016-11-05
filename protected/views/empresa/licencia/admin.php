<?php if ($model!=null): ?>
<?php echo BsHtml::pageHeader('Licencias asignadas') ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th style="width:20px">ID</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th style="width:200px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($model as $key=>$data): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?=$data->primaryKey ?></td>
			<td><?php echo $data->nombre ?></td>
			<td><?php echo $data->descripcion ?></td>
			<td>
				<?php
					#modal de eliminar
					echo BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_TRASH).' Eliminar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
					    'data-target'=>'#EliminarLic'.$key,
					    'data-toggle'=>'modal'
					));
					$this->widget('bootstrap.widgets.BsModal', array(
					    'id' => 'EliminarLic'.$key,
					    'header' => "¿Desea eliminar a '$data->nombre' ?",
					    'content' => "<p>Se quitara de la lista $data->nombre</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
							'onclick'=>"window.location.href='".Yii::app()->createUrl("empresa/deleteLic",array("id"=>$data->primaryKey))."'",
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
					'onclick'=>"window.location.href='".Yii::app()->createUrl("empresa/editLic",array("id"=>$data->primaryKey))."'",
				));?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>