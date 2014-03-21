<?php
/* @var $this IngredientController */
/* @var $model Ingredient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ingredient_name'); ?>
		<?php echo $form->textField($model,'ingredient_name',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'ingredient_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ingredient_match_name'); ?>
		<?php echo $form->textField($model,'ingredient_match_name',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'ingredient_match_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ingredient_image'); ?>
		<?php echo $form->fileField($model,'ingredient_image'); ?>
		<?php echo $form->error($model,'ingredient_image'); ?>
	</div>
        <p>Square Image (226x226) pref</p>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->