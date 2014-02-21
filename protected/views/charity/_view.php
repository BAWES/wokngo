<?php
/* @var $this CharityController */
/* @var $data Charity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('charity_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->charity_id), array('view', 'id'=>$data->charity_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charity_name')); ?>:</b>
	<?php echo CHtml::encode($data->charity_name); ?>
	<br />


</div>