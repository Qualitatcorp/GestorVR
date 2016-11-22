<?php $this->breadcrumbs=array(Yii::t('Navbar','Empresas'),Yii::t('Navbar','Ver'),Yii::t('Navbar','Fichas de evaluación'));?>
<?php
$this->menu[]=array('label'=>'Empresa');
if(!empty($urlReturn))
$this->menu[]=array('label'=>'Volver','url'=>$urlReturn);
$baseUrl=Yii::app()->baseUrl;
Yii::app()->getClientScript()
	->registerCssFile($baseUrl.'/css/dataTables.bootstrap.min.css')
	->registerScriptFile($baseUrl.'/js/jquery.dataTables.min.js',CClientScript::POS_END)
	->registerScriptFile($baseUrl.'/js/dataTables.bootstrap.min.js',CClientScript::POS_END)
	->registerScript('dataTables', "$('.table').DataTable({

		\"order\": [[ 5, \"desc\" ]],
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
<div class="row">
<div class="col-md-12">
<?=BsHtml::button(Yii::t('Navbar','Busqueda Avanzada'), array(
'data-toggle'=>'collapse',
'data-target'=>'#find',
    // 'color' => BsHtml::BUTTON_COLOR_PRIMARY,
    'size' => BsHtml::BUTTON_SIZE_SMALL,
    'pull' => BsHtml::PULL_RIGHT
));
?>
</div>
<div id="find" class="collapse <?php if($find->activo)echo "in" ?> col-md-12">
	<?php $this->renderPartial('ficha/_advanced',array('model'=>$find)) ?>
</div>
<?php echo BsHtml::pageHeader('Ver Fichas de evaluación') ?>
<div class="col-md-12">
<table class="table">
	<thead>	
		<tr>
			<th style="width:20px">Ficha</th>
			<th><?=Yii::t('Navbar','Trabajador')?></th>
			<th width=85><?=Yii::t('Navbar','RUT')?></th>
			<th><?=Yii::t('Navbar','Evaluacion')?></th>
			<th><?=Yii::t('Navbar','Nota')?></th>
			<th><?=Yii::t('Navbar','Fecha')?></th>
			<th style="width:50px"><?=Yii::t('Navbar','Opciones')?></th>
		</tr>
	</thead>
	<tbody>
			<?php foreach ($model as $ficha): ?>
				<tr>
					<td><?=$ficha->primaryKey; ?></td>
					<td><?=$ficha->trabajador->nombreCompleto ?></td>
					<td><?=$ficha->trabajador->rut ?></td>
					<td><?=(($f=$ficha->evaluacion->traduce())!==null)?$f->nombre:'CORRUPTO' ?></td>
					<td><?=$ficha->nota ?></td>
					<td><?=$ficha->creado ?></td>
					<td><?=BsHtml::buttonGroup(
						array(
							array(
								'label' => 'VER',
								'onClick'=>"window.open('/empresa/viewficha/$ficha->fic_id')",
								'color' => BsHtml::BUTTON_COLOR_INFO
							),
							array(
								'label' => 'PDF',
								'onClick'=>"window.open('/empresa/viewfichapdf/$ficha->fic_id')",
								'color' => BsHtml::BUTTON_COLOR_DANGER
							),
						), 
						array(
							'size' => BsHtml::BUTTON_SIZE_MINI,
						));
					?></td>
			<?php endforeach ?>
	</tbody>
</table>
</div>