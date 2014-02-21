<?php
/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sale', 'url'=>array('index')),
	array('label'=>'Manage Sale', 'url'=>array('admin')),
);
?>

<h1>Create Sale</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>