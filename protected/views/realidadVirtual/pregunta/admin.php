<?php $this->breadcrumbs=array('Evaluación',);?>
<?php echo BsHtml::pageHeader('Administrar','Evaluación') ?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th>Pregunta</th>
			<th>Descripción</th>
			<th style="width:50px">Habilitado</th>
			<th style="width:200px">Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($List as $key=>$model): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $model->descripcion ?></td>
			<td><?php echo $model->comentario ?></td>
			<td><?php echo $model->habilitado ?></td>
			<td>
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
					    'header' => "¿Desea eliminar a '$model->descripcion' ?",
					    'content' => "<p>Se quitara de la lista $model->descripcion</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
								'onclick'=>"window.location.href='deleteEva/$model->eva_id'",
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
					'onclick'=>"window.location.href='editEva/$model->eva_id'",
				));?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>