<?php
/* @var $this EvaluacionAltairController */
/* @var $data EvaluacionAltair */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->alt_id),array('view','id'=>$data->alt_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tra_id')); ?>:</b>
	<?php echo CHtml::encode($data->tra_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::encode($data->iduser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nota')); ?>:</b>
	<?php echo CHtml::encode($data->nota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creado')); ?>:</b>
	<?php echo CHtml::encode($data->creado); ?>
	<br />


</div>