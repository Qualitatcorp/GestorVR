<?php $this->breadcrumbs=array('Evaluación realidad virtual','Ver',);?>
<?php echo BsHtml::pageHeader($model->nombre,$model->tipo->nombre) ?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'tipoNombre:Html:Tipo de evaluación',
		'nombre',
		'descripcion',
		'creado:html:Fecha de creación',
		'habilitado',
		'countEva',
	),
)); ?>
<?php echo BsHtml::pageHeader('Preguntas',$model->nombre) ?>
<table class="table">
	<thead>
		<tr>
			<th style="width:20px">#</th>
			<th style="width:50px">ID</th>
			<th style="width:120px">Imagen</th>
			<th>Pregunta</th>
			<th style="width:50px">Habilitado</th>
			<th style="width:200px">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($model->preguntas as $key => $value): ?>
			<tr>
				<td><?=$key+1?></td>
				<th><?=$value->pre_id ?></th>
				<td><?=BsHtml::imageRounded($value->UrlImagen,'imagen_pregunta',array("width"=>100,"height"=>100));?></td>
				<td><?=$value->descripcion ?></td>
				<td><?=$value->habilitado ?></td>
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
					    'header' => "¿Desea eliminar a '$value->descripcion' ?",
					    'content' => "<p>Se quitara de la lista $value->descripcion</p>",
					    'footer' => array(
					        BsHtml::Button('Eliminar de todos modos', array(
								'onclick'=>"window.location.href='../deletePre/$value->pre_id'",
							    'color' => BsHtml::BUTTON_COLOR_DANGER
							)),
					        BsHtml::button('Cancelar', array(
					            'data-dismiss' => 'modal'
					        )),
					    )
					));?>
					<?= BsHtml::Button(BsHtml::icon(BsHtml::GLYPHICON_EDIT).' Modificar', array(
					    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
					    'size' => BsHtml::BUTTON_SIZE_SMALL,
						'onclick'=>"window.location.href='../editPre/$value->pre_id'",
					));?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

