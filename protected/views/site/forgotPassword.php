<?php
/* @var $this SiteController */
/* @var $model ForgotPasswordForm */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
$this->pageHeader = "Reset Password";
?>


<div class="form" style="margin-top:1em;">
<?php 
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'forgot-password-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <p>
        Please fill out the form to reset your password
    </p>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons" style="margin-top:1em;">
		<?php echo CHtml::submitButton('Reset Password', array('class' => 'genericButton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->