<?php
/* @var $this ProfileController */
/* @var $title */
/* @var $content */

//This is a generic re-usable page

$this->pageTitle = Yii::app()->name . ' - '.$title;
$this->pageHeader = "$title";

echo "<p>$content</p>";

$link = Yii::app()->createUrl('profile/index');

echo "<br/><a href='$link' class='genericButton' style='color:white'>Back to Profile</a>"
?>
