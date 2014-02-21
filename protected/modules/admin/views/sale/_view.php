<?php
/* @var $this SaleController */
/* @var $data Sale */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sale_id), array('view', 'id'=>$data->sale_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->sale_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->sale_datetime); ?>
	<br />


</div>