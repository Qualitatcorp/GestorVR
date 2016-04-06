<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_rut')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usu_rut),array('view','id'=>$data->usu_rut)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_rut')); ?>:</b>
	<?php echo CHtml::encode($data->emp_rut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->usu_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_apellido')); ?>:</b>
	<?php echo CHtml::encode($data->usu_apellido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_password')); ?>:</b>
	<?php echo CHtml::encode($data->usu_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_rol')); ?>:</b>
	<?php echo CHtml::encode($data->usu_rol); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_fono')); ?>:</b>
	<?php echo CHtml::encode($data->usu_fono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_email')); ?>:</b>
	<?php echo CHtml::encode($data->usu_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->usu_fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usu_desabilitado')); ?>:</b>
	<?php echo CHtml::encode($data->usu_desabilitado); ?>
	<br />

	*/ ?>

</div>