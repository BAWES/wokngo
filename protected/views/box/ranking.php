<?php
/* @var $this BoxController */
/* @var $topBoxes array */

$this->pageTitle = Yii::app()->name . ' - Top Wokers';
?>


<header id='ranking'>
    <h1>Top Wokers</h1>
    <h2>Search Boxes</h2>
    <form method='get'>
        <select id='type' name='type'>
            <option value='top' selected='selected'>Top Wokers</option>
            <option value='trending'>Trending Wokers</option>
            <option value='new'>New Wokers</option>
        </select>
        <input type='text' id='keyword' name='keyword' placeholder='Enter keyword...'/>
        <a href='#search'>Search</a>
    </form>
    <script>
        $('#type').change(function(){
            var selected = $(this).val();
            switch(selected){
                case 'top':
                    window.location = "<?php echo Yii::app()->createUrl("box/ranking"); ?>";
                    break;
                case 'trending':
                    window.location = "<?php echo Yii::app()->createUrl("box/trending"); ?>";
                    break;
                case 'new':
                    window.location = "<?php echo Yii::app()->createUrl("box/new"); ?>";
                    break;
            }
        });
    </script>
</header>

<section id='rankingList'>
    <!-- Start Listing Boxes -->

    <?php
    $i = 0;
    foreach ($topBoxes as $box) {
        $i++;

        //Add Image Link
        if ($box['item_image'] == null) {
            $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/default.jpg";
        } else {
            $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/" . $box['item_image'];
        }
        ?>

        <a href='#box<?php echo $box['item_id']; ?>'>
            <b><?php echo $i; ?></b>
            <div class='img'><img src='<?php echo $box['item_image']; ?>' alt='<?php echo $box['item_name']; ?>'/></div>
            <div class='boxDetails'>
                <h3><?php echo $box['item_name']; ?></h3>
                <h4><?php echo $box['customer_name']; ?></h4>
                <p>
                    <?php echo $box['item_description']; ?>
                </p>
            </div>
            <div class='numSold'>
                <?php echo (int) $box['sales']; ?> <span>Boxes Sold</span>
            </div>
            <div class='clear'></div>
        </a>

    <?php } ?>

    <br/>
</section>