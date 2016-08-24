<?php $this->breadcrumbs=array(
	'Empresas',
	'Administrar',
);?>

<?php echo BsHtml::pageHeader('Administrar','Empresas') ?>
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'empresa-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
    		// 'emp_id',
			'nombre',
			// 'rut',
			// 'com_id',
			'razon_social',
			// 'giro',
			// 'fono',
			// 'mail',
			// 'creado',
			// 'activa',
			array(
				'class'=>'bootstrap.widgets.BsButtonColumn',
			),
				// array(
				//     'class'=>'CButtonColumn',
				//     'template'=>'{email}{down}{delete}',
				//     'buttons'=>array
				//     (
				//         'email' => array
				//         (
				//             'label'=>'Send an e-mail to this user',
				//             'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
				//             'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->emp_id))',
				//         ),
				//         'down' => array
				//         (
				//             'label'=>'[-]',
				//             'url'=>'"#"',
				//             // 'visible'=>'$data->nombre > 0',
				//             'click'=>'function(){alert("Going down!");}',
				//         ),
				//     ),
				// ),
			),
        )); ?>
<?php if (is_array($model)): ?>
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
				<td><?php echo $data->rut ?></td>
				<td><?php echo $data->nombre ?></td>
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
						    'header' => "¿Desea eliminar a '$data->nombre' ?",
						    'content' => "<p>Se quitara de la lista $data->nombre</p>",
						    'footer' => array(
						        BsHtml::Button('Eliminar de todos modos', array(
									'onclick'=>"window.location.href='deleteUsu/$data->emp_id'",
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
							'onclick'=>"window.location.href='updateUsu/$data->emp_id'",
						));
					?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>



