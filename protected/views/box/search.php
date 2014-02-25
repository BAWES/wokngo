<?php
/* @var $this BoxController */
/* @var $keyword string */
/* @var $boxResults Item */

$this->pageTitle = Yii::app()->name . ' - Search Results';
?>


<header id='ranking'>
    <h1>Search Results</h1>
    <h2>Search Boxes</h2>
    <form method='get' action="<?php echo Yii::app()->createUrl("box/search"); ?>">
        <select id='type' name='type'>
            <option value='top'>Top Wokers</option>
            <option value='trending'>Trending Wokers</option>
            <option value='new'>New Wokers</option>
        </select>
        <input type='text' id='keyword' name='keyword' placeholder='Enter keyword...' value="<?php echo $keyword; ?>"/>
        <a href='#search'>Search</a>
    </form>
    <script>
        $('#type').change(function() {
            var selected = $(this).val();
            switch (selected) {
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
    foreach ($boxResults as $box) {
        $i++;
        //be sure query for newBoxes has "with" for both customer details and numSold from sales
        ?>

        <a href='#box<?php echo $box->item_id; ?>'>
            <b><?php echo $i; ?></b>
            <div class='img'><img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/></div>
            <div class='boxDetails'>
                <h3><?php echo $box->item_name; ?></h3>
                <h4><?php echo $box->customer->customer_name; ?></h4>
                <p>
                    <?php echo $box->item_description; ?>
                </p>
            </div>
            <div class='numSold'>
                <?php echo (int) $box->totalSold; ?> <span>Boxes Sold</span>
            </div>
            <div class='clear'></div>
        </a>

    <?php } 
    if($i == 0){
        //no search results
    ?>
    <p>No results found for <span style="font-weight:bold;"> <?php echo $keyword;?> </span></p>
    <?php } ?>

    <br/>
</section>