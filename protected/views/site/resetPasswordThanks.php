<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
$this->pageHeader = "Reset Password";
?>


Your password has been changed

<br/><br/>
<a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="genericButton" style="color:white">Sign in</a>