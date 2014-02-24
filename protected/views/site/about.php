<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - About';
$this->pageHeader = "About";
?>

<p>About Wok&amp;Go content will go here</p>

<?php
//testing of models here - delete this later


//Step 1 - Find Last Sale Date
$lastSale = Sale::model()->latest()->find();

$lastSaleDate = date("Y-m-d",strtotime($lastSale->sale_datetime));
echo $lastSaleDate;

/*
 * 
 * $items=Item::model()->with(array(
    'sale'=>array(
        // we don't want to select sales
        'select'=>false,
        // but want to get only items with most sales in past 5 days
        'joinType'=>'INNER JOIN',
        'condition'=>'sale.sale_datetime<lastSaleDate && sale.sale_datetime>lastSaleDate-5 days',
        'order'=>sale.sale_datetime DESC
    ),
))->findAll();
 * 
 * We will use similar to above function
 * Get all items that have sales within (5 days) of last sale in db
 */

?>