<?php
/* @var $this BoxController */
/* @var $box Box */

$this->pageTitle = Yii::app()->name . ' - '.$box->item_name;

//Share link
$shareLink = Yii::app()->createUrl('box/view',array('seo'=>$box->item_seo_name));
?>



<header id='box'>
    <div class='rank'>Rank <span><?php echo $box->rank; ?></span></div>
    <img src='<?php echo $box->image; ?>' alt='<?php echo $box->item_name; ?>'/>
    <h1><?php echo $box->item_name; ?> <span><?php echo $box->customer->customer_name; ?></span></h1>
    <a href='#share' id='shareBtn'>Share This</a>

    <a href='https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareLink;?>' class='fbShare' target='_blank'></a>
    <a href='http://www.twitter.com/share?text=Check+out+this+box+<?php echo $box->item_name;?>&amp;url=<?php echo $shareLink;?>' class='twitterShare' target='_blank'></a>

    <div class='boxesSold'>Total Boxes Sold <span><?php echo $box->totalSold; ?></span></div>
    <div class='clear'></div>
</header>

<section id='description'>
    <h1>Description</h1>
    <p>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque 
        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia
        dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
        quaerat voluptatem.
    </p>
</section>

<section id='ingredients'>
    <h1>Ingredients</h1>
    <div id='ingredientList' class='owl-carousel'>
        <div>
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ingredients/eggnoodles.jpg' alt="Egg Noodles"/>
            <p>Egg Noodles</p>
        </div>
        <div>
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ingredients/shrimp.jpg'alt="Shrimp"/>
            <p>Shrimp</p>
        </div>
        <div>
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ingredients/hotchilisauce.jpg' alt="Hot Chili Sauce"/>
            <p>Hot Chili Sauce</p>
        </div>
        <div>
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ingredients/carrots.jpg' alt="Carrots"/>
            <p>Carrots</p>
        </div>
    </div>
</section>

<section id='sales'>
    <h1>Box Sales</h1>
    <div id="chart" style="height: 18.75em; margin: 0 auto; width:100%"></div>
    <script type="text/javascript">
        $(function() {
            $('#chart').highcharts({
                chart: {
                    zoomType: 'x',
                    spacingRight: 20
                },
                title: {
                    text: false
                },
                subtitle: {
                    text: false
                },
                xAxis: {
                    type: 'datetime',
                    maxZoom: 14 * 24 * 3600000, // fourteen days
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    title: {
                        text: 'Boxes Sold'
                    },
                    min: 0
                },
                tooltip: {
                    shared: true
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        },
                        shadow: false,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },
                series: [{
                        type: 'area',
                        name: 'Boxes',
                        pointInterval: 24 * 3600 * 1000,
                        pointStart: Date.UTC(2014, 0, 01),
                        data: [
                            3, 0, 1, 5, 8, 4, 1, 10, 0, 0, 0, 5, 15, 20, 2, 5, 0, 0, 0, 1
                        ]
                    }]
            });
        });

    </script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
</section>