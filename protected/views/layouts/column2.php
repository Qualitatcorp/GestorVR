<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

	<div id="content">
<?php if (!empty($this->menu)) 
echo BsHtml::buttonDropdown('Opciones',
$this->menu
, array(
    // 'split' => true,
    'size' => BsHtml::BUTTON_SIZE_SMALL,
    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
));
?>
		<?php echo $content; ?>
	</div><!-- content -->
</div>
</div>
<?php $this->endContent(); ?>