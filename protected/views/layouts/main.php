<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/km.main.css?ver=1' type='text/css' />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/owl.carousel.css" type='text/css' />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/owl.theme.css" type='text/css' />

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
        <header id="mainheader">
            <div id='logoArea'>
                <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" id='logo'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/logo.png" alt='Wok Logo'/></a>

                <ul id='socialLinks'>
                    <li><a href="#" class='facebook'></a></li>
                    <li><a href="#" class='twitter'></a></li>
                    <li><a href="#" class='instagram'></a></li>
                </ul>

                <a href="#" id="navLink"></a>
            </div>

            <nav>
                <ul>
                    <li><a href='<?php echo Yii::app()->createUrl('site/index'); ?>'>Home</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/about'); ?>'>About Us</a></li>
                    <li><a href='<?php echo Yii::app()->request->baseUrl; ?>/menu.pdf'>Menu</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('box/index'); ?>'>Wokers</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/franchise'); ?>'>Franchise</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/contact'); ?>'>Contact Us</a></li>
                    <li id="orderOnline"><a href='http://www.6alabat.com' target="_blank">Order Online <span>From 6alabat.com</span></a></li>
                    <li id="delivery"><a href='tel:22202225'>For Delivery <span>+965 2220 2225</span></a></li>
                    <?php if(!Yii::app()->user->isGuest){ ?>
                    <li id="signin"><a href='<?php echo Yii::app()->createUrl('site/logout'); ?>'>Profile</a></li>
                    <?php }else{ ?>
                    <li id="signin"><a href='<?php echo Yii::app()->createUrl('site/signin'); ?>'>Sign in</a></li>
                    <?php } ?>
                </ul>
                <div class='clear'></div>
            </nav>
        </header>

        <!-- Content Area -->
        <section id='contentArea'>
            <section id="content">
                
                <?php echo $content; ?>
                
            </section>
        </section>

        <!-- Footer Area -->
        <footer>
            <section id='feeds'>
                <!-- Facebook Page Feed -->
                <section class='socialFeed' id='facebook'>
                    <a href='#'>WOK&amp;GO On <span>Facebook</span></a>
                    <div>
                        Feed goes here
                    </div>
                </section>

                <!-- Twitter Page Feed -->
                <section class='socialFeed' id='twitter'>
                    <a href='#'>WOK&amp;GO On <span>Twitter</span></a>
                    <div>
                        Feed goes here
                    </div>
                </section>

                <!-- Instagram Page Feed -->
                <section class='socialFeed' id='instagram'>
                    <a href='#'>WOK&amp;GO On <span>Instagram</span></a>
                    <div>
                        Feed goes here
                    </div>
                </section>
                <div class='clear'></div>
            </section>
            
            <section id='about'>
                <h1>About us</h1>
                <p>
                    Wok&Go is about fresh, nutritious, tasty food that is cooked in front of your eyes and served to you in minutes.
                    <br/><br/>Sounds simple? It is. Simple, affordable, irresistible food!

                </p>
                <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/logosmall.png' alt='Wok Logo 2'/>
                <div class='clear'></div>
            </section>

            <section id='copyright'>
                <p>Copyright <?php echo date('Y'); ?> Wok & Go. All Rights Reserved</p>
                <a href='http://www.khalidm.net' title='Developed by Khalidmnet'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/kmnet.png' alt='Khalidm.net Developer Logo'/></a>
                <div class='clear'></div>
            </section>
        </footer>
    </body>
</html>
