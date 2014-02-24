<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - About';
$this->pageHeader = "About";
?>

<p>About Wok&amp;Go content will go here</p>

<?php
//HERE WE WILL START WORKING ON RANKING SYSTEM
//ADD getRank to each Items model

//Items ordered by Sales
$items = Item::model()->with(array(
                    'totalSold' => array(
                        'select' => true,
                        'joinType' => 'INNER JOIN',
                        'order' => 'totalSold DESC'
            )))->findAll();

?>