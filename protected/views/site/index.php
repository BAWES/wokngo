<?php
/* @var $this SiteController */
/* @var $newBoxes Item */
/* @var $trendingBoxes Item */

$this->pageTitle = Yii::app()->name;
?>

<!-- Slider -->
<div class="slider">
    <ul>
        <li>
            <h1>Sweet Chili</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#">Our Menu</a>
        </li>
        <li style="background-color:#fa9312;">
            <h1>Order Online!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#">Order Now</a>
        </li>
        <li style="background-color:#10b58c;">
            <h1>Franchise</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#">More Info</a>
        </li>
    </ul>
</div>

<!-- Wokers Area -->
<section id='wokersArea'>
    <!-- New Wokers -->
    <section id='newWok' class="wokersList">
        <header>
            <a href="ranking.html"><h2>New Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <?php $i = 0;
                foreach($newBoxes as $box){ $i++; ?>
                
                <a href='#box<?php echo $box->item_id; ?>'>
                    <b><?php echo $i;?></b>
                    <img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/>
                    <p><?php echo $box->item_name; ?></p>
                    <div class='clear'></div>
                </a>
                    
                <?php }?>
            </div>
        </div>

    </section>

    <!-- Trending Wokers -->
    <section id='trendingWok' class="wokersList">
        <header>
            <a href="ranking.html"><h2>Trending Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <?php $i = 0;
                foreach($trendingBoxes as $box){ $i++; 
                    if($i==11) break; ?>
                
                <a href='#box<?php echo $box->item_id; ?>'>
                    <b><?php echo $i;?></b>
                    <img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/>
                    <p><?php echo $box->item_name; ?></p>
                    <div class='clear'></div>
                </a>
                    
                <?php }?>
            </div>
        </div>

    </section>

    <!-- Trending Wokers -->
    <section id='top10Wok' class="wokersList">
        <header>
            <a href="ranking.html"><h2>Top 10 Wokers</h2></a>
            <a href="#up" class="scroll up"></a>
            <a href="#down" class="scroll down active"></a>
        </header>

        <div class='boxList'>
            <div class='boxes'>
                <a href='box.html'>
                    <b>1</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>2</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>3</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>4</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>5</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>6</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>7</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>8</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>9</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>

                <a href='box.html'>
                    <b>10</b>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/defaultbox.jpg' alt='Box Image'/>
                    <p>Box Name Goes Here...</p>
                    <div class='clear'></div>
                </a>
            </div>
        </div>

    </section>
    <div class='clear'></div>
</section>

<!-- About Banner -->
<section id='aboutBanner' style='background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/layout/foodbanner.jpg);'>
    <div>
        <h1><span>WOK</span>&amp;GO</h1>
        <h2>THE TASTE OF ASIA</h2>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        </p>
    </div>
</section>

<!-- Tasty News / Subscribe -->
<section id='subscribe'>
    <h1>TASTY NEWS!</h1>
    <p>Subscribe Now</p>
    <form method='post'>
        <input type='email' name='email' class='email' placeholder='Your Email' required/>
        <div class='submit'></div>
    </form>
</section>

<!-- Orders Banner -->
<section id='orders'>
    <h1>WE DELIVER</h1>
    <p>Please call us 22202225</p>
    <a href='http://www.6alabat.com'>Order Online</a>
</section>
<div class='clear'></div>
