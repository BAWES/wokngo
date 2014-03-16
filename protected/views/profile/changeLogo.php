<?php
/* @var $this ProfileController */
/* @var $model LogoForm */
/* @var $box Item */

$this->pageTitle = Yii::app()->name . ' - Change Box Logo';
$this->pageHeader = "Change Logo";
?>


<div class="form" style="margin-top:1em;">
<?php 
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'logo-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <b>Box: </b><?php echo $box->item_name; ?> <br/>
    <b>Logo: </b><br/> <img src='<?php echo $box->image; ?>'/> <br/><br/>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->fileField($model,'logo'); ?>
		<?php echo $form->error($model,'logo'); ?>
	</div>
        <p style='color:green; font-size:0.8em;'>Square images recommended</p>

	<div class="row buttons" style="margin-top:1em;">
		<?php echo CHtml::submitButton('Change Logo', array('class' => 'genericButton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->