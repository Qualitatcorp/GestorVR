<?php 
$this->beginWidget('bootstrap.widgets.BsPanel',array(
	'title'=>BsHtml::bold(BsHtml::italics(Yii::t('Welcome','Bienvenido a QualitatCorp'))),
	'footer'=>BsHtml::italics('Simulador de Qualitatcorp<br>
Dalcahue 1120, Oficina 201 - San Pedro de la Paz, VIII Región'),
	'footerCssClass'=>'panel-foot-x'
	));
?>
<div class="row">
		<div class="col-xs-12 col-sm-2 pull-right">
		<?php echo BsHtml::imageThumbnail(	Yii::app()->request->baseUrl."/images/logo.png",'',$htmlOptions = array(
					'style'=> 'border-radius: 15px;margin-bottom: 10%;border:none;padding:-5% -5%'));?>
		</div>
		<div class="col-xs-12 col-sm-12">
		<?php  echo BsHtml::lead(Yii::t('Welcome','Bienvenido a la Plataforma de Realidad Virtual Inmersiva')."<br>".
					Yii::t('Welcome','Plataforma de administración web Versión 4.0 ')."<br>".Yii::t('Welcome','©2016 Qualitatcorp todos los derechos reservados.'));
			?>
		</div>
</div>
<?php 
	$this->endWidget();
?>