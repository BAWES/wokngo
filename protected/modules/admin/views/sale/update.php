<?php
/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->sale_id=>array('view','id'=>$model->sale_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sale', 'url'=>array('index')),
	array('label'=>'Create Sale', 'url'=>array('create')),
	array('label'=>'View Sale', 'url'=>array('view', 'id'=>$model->sale_id)),
	array('label'=>'Manage Sale', 'url'=>array('admin')),
);
?>

<h1>Update Sale <?php echo $model->sale_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>