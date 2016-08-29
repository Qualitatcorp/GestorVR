<?php $this->breadcrumbs=array('Empresas','Ver','Fichas de evaluación');?>
<?php echo BsHtml::pageHeader('Ver Fichas de evaluación',$model->nombre) ?>
<?php
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
<?php 
// var_dump(RvFicha::command()->where('empresa.emp_id=:id', array(':id'=>$model->emp_id))->order('rv_ficha.creado desc')->queryALL());
?>
<table class="table">
	<thead>	
		<tr>
			<th style="width:20px">Ficha</th>
			<th>Trabajador</th>
			<th width=85>RUT</th>
			<th>Evaluacion</th>
			<th>Nota</th>
			<th>Fecha</th>
			<th style="width:50px">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($model->dispositivos as $disp): ?>
			<?php foreach ($disp->fichas as $ficha): ?>
				<tr>
					<td><?=$ficha->primaryKey; ?></td>
					<td><?=$ficha->trabajador->nombreCompleto ?></td>
					<td><?=$ficha->trabajador->rut ?></td>
					<td><?=(($f=$ficha->evaluacion)!==null)?$f->nombre:'CORRUPTO' ?></td>
					<td><?=$ficha->nota ?></td>
					<td><?=$ficha->creado ?></td>
					<td><?=BsHtml::button('Mirar',array('onClick'=>"window.open('../viewFicha/$ficha->fic_id')",
    'color' => BsHtml::BUTTON_COLOR_PRIMARY)) ?></td>
				</tr>
			<?php endforeach ?>
		<?php endforeach ?>
	</tbody>
</table>
    <?=BsHtml::button('Volver',array('onClick'=>"window.location.href='../$model->emp_id'",
    'color' => BsHtml::BUTTON_COLOR_PRIMARY)) ?>