<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs = array(
    'Boxes' => array('index'),
    'Manage',
);

$this->menu = array(
        //array('label'=>'Create Item', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Boxes</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'item-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'item_id',
        array(
            'name' => 'customer_search',
            'value' => '$data->customer->customer_name',
            //'filter' => CHtml::listData(Customer::model()->findAll(), 'customer_name', 'customer_name'),
        ),
        'item_name',
        'item_ingredients',
        'item_image',
        'item_description',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
