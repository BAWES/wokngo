<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customer_id), array('view', 'id'=>$data->customer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_name')); ?>:</b>
	<?php echo CHtml::encode($data->customer_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_phone')); ?>:</b>
	<?php echo CHtml::encode($data->customer_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_email')); ?>:</b>
	<?php echo CHtml::encode($data->customer_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_password')); ?>:</b>
	<?php echo CHtml::encode($data->customer_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_civil_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_civil_id); ?>
	<br />


</div>