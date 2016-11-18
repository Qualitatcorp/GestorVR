<?php $language=(isset($_POST['language']))?$_POST['language']:null; ?>
	<div class="row">
		<div class="col-md-12">
				<?=BsHtml::pageHeader(Yii::t('Navbar',"Ficha de evaluación"),"<br>".$model->dispositivo->empresa->nombre."<br>".$model->evaluacion->traduce()->nombre."<br>".$model->trabajador->rut."<br>".$model->trabajador->nombreCompleto."<br>".Yii::t('Navbar','NOTA')." : ".$model->Nota,$htmlOptions=array('style'=>'position: relative;padding-top: 0px;'))?>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width:20px">#</th><th style="width:100px"><?=Yii::t('Navbar','Imagen')?></th><th align="center"><?=Yii::t('Navbar','Descripción')?></th><th align="center"><?=Yii::t('Navbar','Respuesta')?></th><th align="center"><?=Yii::t('Navbar','Resultado')?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($model->respuestas as $key => $value): ?>
					<tr>
						<td><?=$key+1 ?></td>
						<?php $pregunta=$value->alternativa->pregunta->traduce($language); ?>
						<td><?=$pregunta->renderImagen ?></td>
						<td align="center"><?=BsHtml::bold($pregunta->descripcion).'<br>'.BsHtml::italics($pregunta->comentario) ?></td>
						<td><?=$value->alternativa->traduce($language)->descripcion ?></td>
						<td align="center"><?=$value->alternativa->renderCorrecto ?></td>
					</tr>
					<?php endforeach ?>
			</tbody>
		</table>
		<p align="right"><?=$model->creado ?></p>
		</div>
		</div>