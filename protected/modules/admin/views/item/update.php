<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Boxes'=>array('index'),
	$model->item_id=>array('view','id'=>$model->item_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Boxes', 'url'=>array('index')),
	array('label'=>'View Box', 'url'=>array('view', 'id'=>$model->item_id)),
);
?>

<h1>Update Box <?php echo $model->item_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>