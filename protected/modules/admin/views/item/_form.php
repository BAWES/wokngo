<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'item_name'); ?>
		<?php echo $form->textField($model,'item_name',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_seo_name'); ?>
		<?php echo $form->textField($model,'item_seo_name',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'item_seo_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_ingredients'); ?>
		<?php echo $form->textArea($model,'item_ingredients',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'item_ingredients'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_image'); ?>
		<?php echo $form->textField($model,'item_image',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'item_image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_description'); ?>
		<?php echo $form->textArea($model,'item_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'item_description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->