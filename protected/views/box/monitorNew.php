<!DOCTYPE html>
<html>
    <head>
        <title>Wok&amp;Go</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/monitor.css?ver=1' type='text/css' />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <!--[if lt IE 8]>
        <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/ie7.css' type='text/css' />
        <![endif]-->

        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/owl.carousel.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.touchSwipe.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/unslider.min.js"></script>

        <!--[if lt IE9]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/css3mediaqueries.js"></script>
        <![endif]-->

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    </head>
    <body>


        <!-- Content Area -->
        <section id='contentArea'>
            <section id="content">
                <header id='ranking'>
                    <h1>New Wokers</h1>
                </header>

                <section id='rankingList'>
                    <!-- Start Listing Boxes -->
                    <?php
                    $i = 0;
                    foreach ($newBoxes as $box) {
                        $i++;
                        //be sure query for newBoxes has "with" for both customer details and numSold from sales
                        ?>


                        <a href='#'>
                            <b><?php echo $i; ?></b>
                            <div class='img'><img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/></div>
                            <div class='boxDetails'>
                                <h3><?php echo $box->item_name; ?></h3>
                                <h4><?php echo $box->customer->customer_name; ?></h4>
                            </div>
                            <div class='numSold'>
                                <?php echo (int) $box->totalSold; ?> <span>Boxes Sold</span>
                            </div>
                            <div class='clear'></div>
                        </a>

                    <?php } ?>



                    <br style='clear:both;'/>

                </section>

            </section>
        </section>

    </body>
</html>
