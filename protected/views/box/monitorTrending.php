<!DOCTYPE html>
<html>
    <head>
        <title>Wok&amp;Go</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/monitor.css?ver=4' type='text/css' />

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
        <script>
            var speed = 10000;
            setTimeout(refresh, speed);
            function refresh() {

                $('#rankingList').load("<?php echo Yii::app()->createUrl("box/monitorTrending",array('refresh'=>'true')) ?>", function() {
                    setTimeout(refresh, speed);
                });

            }
        </script>
    </head>
    <body>


        <!-- Content Area -->
        <section id='contentArea'>
            <section id="content">
                <header id='ranking'>
                    <h1>Trending Wokers</h1>
                </header>

                <section id='rankingList'>
                    <!-- Start Listing Boxes -->

                </section>

            </section>
        </section>

    </body>
</html>
