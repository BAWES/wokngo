<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->pageHeader = "Error ".$code;
?>

<?php echo CHtml::encode($message); ?>