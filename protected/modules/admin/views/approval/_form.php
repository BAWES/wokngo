<?php
/* @var $this ApprovalController */
/* @var $model Approval */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'approval-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
		<?php echo $form->error($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_type'); ?>
		<?php echo $form->textField($model,'approval_type',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'approval_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_text'); ?>
		<?php echo $form->textArea($model,'approval_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'approval_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->