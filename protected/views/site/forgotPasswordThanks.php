<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
$this->pageHeader = "Reset Password";
?>


You will now receive an email containing a link to reset your password

<br/><br/>
<a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="genericButton" style="color:white">Back to Home</a>