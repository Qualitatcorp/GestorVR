<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iduser),array('view','id'=>$data->iduser)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regdate')); ?>:</b>
	<?php echo CHtml::encode($data->regdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actdate')); ?>:</b>
	<?php echo CHtml::encode($data->actdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logondate')); ?>:</b>
	<?php echo CHtml::encode($data->logondate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('authkey')); ?>:</b>
	<?php echo CHtml::encode($data->authkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalsessioncounter')); ?>:</b>
	<?php echo CHtml::encode($data->totalsessioncounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currentsessioncounter')); ?>:</b>
	<?php echo CHtml::encode($data->currentsessioncounter); ?>
	<br />

	*/ ?>

</div>