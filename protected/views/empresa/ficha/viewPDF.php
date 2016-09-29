<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/css/bootstrap.cerulean.min.css" />
</head>
<body>
<div class="content">
	
	<div class="row">
		<div class="col-xs-3">
			<img src="<?=Yii::app()->request->baseUrl?>/images/ficha/logo.png" height="120px" width="120px">
		</div>
		<div class="col-xs-6">
			<?=BsHtml::pageHeader("Ficha de evaluación","<br>".$model->dispositivo->empresa->nombre."<br>".$model->evaluacion->nombre."<br>".$model->trabajador->rut."<br>".$model->trabajador->nombreCompleto,$htmlOptions=array('style'=>'position: relative;padding-top: 0px;'))?>
		</div>
		<div style="width:15%">
			<?php
				$this->beginWidget('bootstrap.widgets.BsPanel', array(
				    'title' => '<p align="center">NOTA</p>',
				));
			?>
			<p align="center"><?= $model->Nota ?></p>
			<?php $this->endWidget();?>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width:20px">#</th><th style="width:100px">Imagen</th><th align="center">Descripción</th><th align="center">Respuesta</th><th align="center">Resultado</th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($model->respuestas as $key => $value): ?>
					<tr>
						<td><?=$key+1 ?></td>
						<?php $pregunta=$value->alternativa->pregunta; ?>
						<td><?=$pregunta->renderImagen ?></td>
						<td align="center"><?=BsHtml::bold($pregunta->descripcion).'<br>'.BsHtml::italics($pregunta->comentario) ?></td>
						<td><?=$value->alternativa->descripcion ?></td>
						<td align="center"><?=$value->alternativa->renderCorrecto ?></td>
					</tr>
					<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<p align="right"><?=$model->creado ?></p>
</body>
</html>