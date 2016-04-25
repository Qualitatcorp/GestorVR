<?php
/* @var $this TrabajadorController */
/* @var $data Trabajador */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tra_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tra_id),array('view','id'=>$data->tra_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paterno')); ?>:</b>
	<?php echo CHtml::encode($data->paterno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materno')); ?>:</b>
	<?php echo CHtml::encode($data->materno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fono')); ?>:</b>
	<?php echo CHtml::encode($data->fono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
	<?php echo CHtml::encode($data->mail); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('creacion')); ?>:</b>
	<?php echo CHtml::encode($data->creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modificado')); ?>:</b>
	<?php echo CHtml::encode($data->modificado); ?>
	<br />

	*/ ?>

</div>