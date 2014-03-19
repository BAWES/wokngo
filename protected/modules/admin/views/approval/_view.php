<?php
/* @var $this ApprovalController */
/* @var $data Approval */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->approval_id), array('view', 'id'=>$data->approval_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item->item_name); ?>
	<br />

        
        <?php  if($data->approval_type == "image"){ ?>
        
            <b>Logo:</b><br/>
            <?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/box/".$data->approval_text); ?>
            <br />
        
        <?php }else{ ?>
        
            <b>Description:</b><br/>
            <?php echo CHtml::encode($data->approval_text); ?>
            <br />
            
        <?php } ?>

            <br/>
            <a href='#'>Approve</a> - <a href='#'>Reject</a>

</div>