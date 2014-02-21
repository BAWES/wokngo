<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->item_id), array('view', 'id'=>$data->item_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_name')); ?>:</b>
	<?php echo CHtml::encode($data->item_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_ingredients')); ?>:</b>
	<?php echo CHtml::encode($data->item_ingredients); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_image')); ?>:</b>
	<?php echo CHtml::encode($data->item_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_description')); ?>:</b>
	<?php echo CHtml::encode($data->item_description); ?>
	<br />


</div>