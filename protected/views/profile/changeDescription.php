<?php
/* @var $this ProfileController */
/* @var $model DescriptionForm */
/* @var $box Item */

$this->pageTitle = Yii::app()->name . ' - Add Box Description';
$this->pageHeader = "Add Description";
?>


<div class="form" style="margin-top:1em;">
<?php 
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'description-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <b>Box: </b><?php echo $box->item_name; ?> <br/>
    <b>Description: </b> <?php echo $box->item_description; ?> <br/><br/>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons" style="margin-top:1em;">
		<?php echo CHtml::submitButton('Add Description', array('class' => 'genericButton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->