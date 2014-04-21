<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" /> 
        <meta property="og:description" content="<?php echo CHtml::encode($this->shareDesc); ?>" />
        <meta property="og:image" content="<?php echo $this->shareImg; ?>" /> 
        
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@wokngo_kw">
        <meta name="twitter:creator" content="@wokngo_kw">
        <meta name="twitter:title" content="<?php echo CHtml::encode($this->pageTitle); ?>">
        <meta name="twitter:description" content="<?php echo CHtml::encode($this->shareDesc); ?>">
        <meta name="twitter:image" content="<?php echo $this->shareImg; ?>">

        <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/km.main.css?ver=3' type='text/css' />
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
        <div id="fb-root"></div>
        <script>
          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=315414895191259";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
        <header id="mainheader">
            <div id='logoArea'>
                <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" id='logo'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/logo.png" alt='Wok Logo'/></a>

                <ul id='socialLinks'>
                    <li><a href="https://www.facebook.com/wokngokw" target="_blank" class='facebook'></a></li>
                    <li><a href="https://twitter.com/wokngo_kw" target="_blank" class='twitter'></a></li>
                    <li><a href="http://instagram.com/wokngo_kw" target="_blank" class='instagram'></a></li>
                </ul>

                <a href="#" id="navLink"></a>
            </div>

            <nav>
                <ul>
                    <li><a href='<?php echo Yii::app()->createUrl('site/about'); ?>'>About Us</a></li>
                    <li><a href='<?php echo Yii::app()->request->baseUrl; ?>/menu.pdf' target="_blank">Menu</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('box/index'); ?>'>Wokers</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/franchise'); ?>'>Franchise</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/locations'); ?>'>Locations</a></li>
                    <li><a href='<?php echo Yii::app()->createUrl('site/contact'); ?>'>Contact Us</a></li>
                    <li id="orderOnline"><a href='http://www.talabat.com/kw/en/restaurant/953/wok--go-kuwait' target="_blank">Order Online <span>From 6alabat.com</span></a></li>
                    <li id="delivery"><a href='tel:22202225'>For Delivery <span>+965 2220 2225</span></a></li>
                    <?php if(!Yii::app()->user->isGuest){ ?>
                    <li id="signin"><a href='<?php echo Yii::app()->createUrl('profile/index'); ?>'>Profile</a></li>
                    <?php }else{ ?>
                    <li id="signin"><a href='<?php echo Yii::app()->createUrl('site/login'); ?>'>Sign in</a></li>
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
                <section class='socialFeed' id='facebook' style="text-align:center;">
                    <a href='https://www.facebook.com/wokngokw' target="_blank">WOK&amp;GO On <span>Facebook</span></a>
                    <div style="margin-top:0.5em;">
                        <div class="fb-like-box" data-href="https://www.facebook.com/wokngokw" data-height="200" data-colorscheme="dark" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
                    </div>
                </section>

                <!-- Twitter Page Feed -->
                <section class='socialFeed' id='twitter' style="text-align:center;">
                    <a href='https://twitter.com/WokNGo_KW' target="_blank">WOK&amp;GO On <span>Twitter</span></a>
                    <div style="margin-top:0.5em;">
                        <a class="twitter-timeline" href="https://twitter.com/WokNGo_KW" data-widget-id="441693557569511424">Tweets by @WokNGo_KW</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


                    </div>
                </section>

                <!-- Instagram Page Feed -->
                <section class='socialFeed' id='instagram' style="text-align:center;">
                    <a href='http://instagram.com/wokngo_kw' target="_blank">WOK&amp;GO On <span>Instagram</span></a>
                    <div style="margin-top:0.5em; margin-left:0.5em;">
                        <iframe src="http://www.intagme.com/in/?u=d29rbmdvX2t3fHNsfDMwMHwyfDN8fHllc3w1fHVuZGVmaW5lZA==" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:200px; height: 200px" ></iframe>
                    </div>
                </section>
                <div class='clear'></div>
            </section>
            
            <section id='about'>
            </section>

            <section id='copyright'>
                <p>Copyright <?php echo date('Y'); ?> Wok & Go. All Rights Reserved</p>
                <a href='http://www.khalidm.net' title='Developed by Khalidmnet'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/layout/kmnet.png' alt='Khalidm.net Developer Logo'/></a>
                <div class='clear'></div>
            </section>
        </footer>
    </body>
</html>
