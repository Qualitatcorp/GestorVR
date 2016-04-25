<?php
/*
	aqui: $this->beginContent('//layouts/main'); indica que este layout se amolda 
	al layout que se haya definido para todo el sistema, y dentro de el colocara
	su propio layout para amoldar a un CPortlet.
	
	esto es para asegurar que el sistema disponga de un portlet, 
	esto es casi lo mismo que haber puesto en UiController::layout = '//layouts/column2'
	a diferencia que aqui se indica el uso de un archivo CSS para estilos predefinidos
	
	Yii::app()->layout asegura que estemos insertando este contenido en el layout que
	se ha definido para el sistema principal.
*/
?>
<?php 
	$this->beginContent('//layouts/'.Yii::app()->layout); 
?>

<?php	
	if(Yii::app()->user->isSuperAdmin)
		echo Yii::app()->user->ui->superAdminNote();
?>
<div class="content">
	<?php if(Yii::app()->user->checkAccess('admin')): ?>	
	<div class="span-5 last">
		<?= BsHtml::buttonDropdown('Opciones',
			Yii::app()->user->ui->adminItems,
			array(
			    // 'split' => true,
			    'size' => BsHtml::BUTTON_SIZE_SMALL,
			    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
			));
	?>
	</div>	
	<?php endif ?>
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>