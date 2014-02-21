<?php
/* @var $this ApprovalController */
/* @var $data Approval */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->approval_id), array('view', 'id'=>$data->approval_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_type')); ?>:</b>
	<?php echo CHtml::encode($data->approval_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_text')); ?>:</b>
	<?php echo CHtml::encode($data->approval_text); ?>
	<br />


</div>