<?php
/* @var $this SiteController */
/* @var $newBoxes Item */
/* @var $trendingBoxes Item */
/* @var $top10Boxes array */

$this->pageTitle = Yii::app()->name;

//set to true to show promotion area
$showPromotion = false;
?>

<!-- Slider -->
<div class="slider">
    <ul>
        <li>
            <h1>Our Menu</h1>
            <p>Fresh, nutritious, and tasty food</p>
            <a href="menu.pdf" target="_blank">Download</a>
        </li>
        <li style="background-color:#fa9312;">
            <h1>Order Online!</h1>
            <p>Wok&Go is about Fresh, Nutritious, Tasty food that is cooked in front of your eyes and served to you in minutes</p>
            <a href="http://www.talabat.com/kw/en/restaurant/953/wok--go-kuwait" target="_blank">Order Now</a>
        </li>
        <li style="background-color:#10b58c;">
            <h1>Franchise</h1>
            <p>Now with franchises across the North West, North East, Southern England and the Middle East, with Mainland Europe and the USA coming soon...<br/>Wok&Go has become the UK's number one Noodle Bar Chain</p>
            <a href="<?php echo Yii::app()->createUrl('site/franchise'); ?>" target="_blank">More Info</a>
        </li>
    </ul>
</div>

<!-- Wokers Area -->
<?php if($showPromotion){ ?>
<section id='wokersArea'>
    <!-- New Wokers -->
    <section id='newWok' class="wokersList">
        <header>
            <a href="<?php echo Yii::app()->createUrl("box/new"); ?>"><h2>New Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <?php
                $i = 0;
                if($newBoxes){
                foreach ($newBoxes as $box) {
                    $i++;
                    ?>

                    <a href='<?php echo Yii::app()->createUrl('box/view',array('seo'=>$box->item_seo_name)); ?>'>
                        <b><?php echo $i; ?></b>
                        <img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/>
                        <p><?php echo $box->item_name; ?></p>
                        <div class='clear'></div>
                    </a>

                <?php }} ?>
            </div>
        </div>

    </section>

    <!-- Trending Wokers -->
    <section id='trendingWok' class="wokersList">
        <header>
            <a href="<?php echo Yii::app()->createUrl("box/trending"); ?>"><h2>Trending Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <?php
                $i = 0;
                if($trendingBoxes){
                foreach ($trendingBoxes as $box) {
                    $i++;
                    if ($i == 11)
                        break;
                    ?>

                    <a href='<?php echo Yii::app()->createUrl('box/view',array('seo'=>$box->item_seo_name)); ?>'>
                        <b><?php echo $i; ?></b>
                        <img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/>
                        <p><?php echo $box->item_name; ?></p>
                        <div class='clear'></div>
                    </a>

                <?php }} ?>
            </div>
        </div>

    </section>

    <!-- Trending Wokers -->
    <section id='top10Wok' class="wokersList">
        <header>
            <a href="<?php echo Yii::app()->createUrl("box/ranking"); ?>"><h2>Top 10 Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <?php
                $i = 0;
                if($top10Boxes){
                foreach ($top10Boxes as $box) {
                    $i++;
                    if ($i == 11)
                        break;

                    //Add Image Link
                    if ($box['item_image'] == null) {
                        $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/default.jpg";
                    } else {
                        $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/" . $box['item_image'];
                    }
                    ?>

                    <a href='<?php echo Yii::app()->createUrl('box/view',array('seo'=>$box['item_seo_name'])); ?>'>
                        <b><?php echo $i; ?></b>
                        <img src='<?php echo $box['item_image']; ?>' alt='<?php echo $box['item_name']; ?>'/>
                        <p><?php echo $box['item_name']; ?></p>
                        <div class='clear'></div>
                    </a>

                <?php }} ?>
            </div>
        </div>

    </section>
    <div class='clear'></div>
</section>
<?php } ?>

<!-- About Banner -->
<section id='aboutBanner' style='background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/layout/foodbanner.jpg);'>
    <div>
        <h1><span>WOK</span>&amp;GO</h1>
        <h2>THE TASTE OF ASIA</h2>
        <p>
           Wok&Go is about Fresh, Nutritious, Tasty food that is cooked in front of your eyes and served to you in minutes.
        </p>
    </div>
</section>

<!-- Tasty News / Subscribe -->
<section id='subscribe'>
    <h1>TASTY NEWS!</h1>
    <p>Subscribe Now</p>
    <form method='post' action="<?php echo Yii::app()->createUrl('site/subscribe') ?>">
        <input type='email' name='Subscribe[subscribe_email]' class='email' placeholder='Your Email' required/>
        <div class='submit'></div>
    </form>
</section>

<!-- Orders Banner -->
<section id='orders'>
    <h1>WE DELIVER</h1>
    <p>Please call us 22202225</p>
    <a href='http://www.talabat.com/kw/en/restaurant/953/wok--go-kuwait' target="_blank">Order Online</a>
</section>
<div class='clear'></div>
