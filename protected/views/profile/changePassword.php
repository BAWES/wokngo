<?php
/* @var $this ProfileController */
/* @var $user Customer */
/* @var $model PasswordForm */

$this->pageTitle = Yii::app()->name . ' - Change Password';
$this->pageHeader = "Change Password";
?>


<div class="form" style="margin-top:1em;">
<?php 
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'password-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'verifyPassword'); ?>
		<?php echo $form->passwordField($model,'verifyPassword'); ?>
		<?php echo $form->error($model,'verifyPassword'); ?>
	</div>

	<div class="row buttons" style="margin-top:1em;">
		<?php echo CHtml::submitButton('Change Password', array('class' => 'genericButton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->