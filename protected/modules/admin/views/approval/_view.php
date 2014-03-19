<?php
/* @var $this ApprovalController */
/* @var $data Approval */
?>

<div class="view">

	<b>Box:</b>
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
            <a href='<?php echo Yii::app()->createUrl("admin/approval/approve",array('id'=>$data->approval_id)) ?>'>Approve</a> - 
            <a href='<?php echo Yii::app()->createUrl("admin/approval/reject",array('id'=>$data->approval_id)) ?>'>Reject</a>

</div>