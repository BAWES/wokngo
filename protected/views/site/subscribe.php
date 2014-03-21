<?php
/* @var $this SiteController */
/* @var $model Subscribe */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Subscribe';
$this->pageHeader = "Subscribe";
?>


<div class="form">

<?php 
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscribe-form',
	'enableAjaxValidation'=>true,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'subscribe_email'); ?>
		<?php echo $form->textField($model,'subscribe_email'); ?>
		<?php echo $form->error($model,'subscribe_email'); ?>
	</div>

<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Subscribe', array('class' => 'genericButton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->