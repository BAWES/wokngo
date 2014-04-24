<?php
/* @var $this BoxController */
/* @var $box Item */
/* @var $ingredients Ingredient */
/* @var $sales array */
/* @var $ingredientsArr array */

$this->pageTitle = Yii::app()->name . ' - '.$box->item_name;

//Share Image
$this->shareImg = "http://wokandgo.me".$box->shareImage;
if($box->item_description) $this->shareDesc = $box->item_description;

//Share link
$shareLink = Yii::app()->createAbsoluteUrl('box/view',array('seo'=>$box->item_seo_name));
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

<?php if($box->item_description){ ?>
<section id='description'>
    <h1>Description</h1>
    <p>
        <?php echo $box->item_description; ?>
    </p>
</section>
<?php } ?>

<section id='ingredients'>
    <h1>Ingredients</h1>
    <div id='ingredientList' class='owl-carousel'>
        <?php 
        foreach(explode(",", $box->item_ingredients) as $ingredientName){
        $ingredient = $ingredientsArr[$ingredientName] ?>
        <div>
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ingredients/<?php echo $ingredient->ingredient_image; ?>' alt="<?php echo $ingredient->ingredient_name; ?>"/>
            <p><?php echo $ingredient->ingredient_name; ?></p>
        </div>
        <?php } ?>
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
                        data: [
                            <?php 
                            $output = "";
                            $firstRow = "";
                            
                            foreach($sales as $sale){
                                $date = $sale['date'];
                                $quantity = (int) $sale['quantity'];
                                
                                //seperate into year/month/day
                                $date = explode('-',$date);
                                $year = (int)$date[0];
                                $month = (int)$date[1]-1;
                                $day = (int)$date[2];
                                $output .= "[Date.UTC($year, $month, $day), $quantity ],";
                                if(!$firstRow){
                                    $newDay = $day-1;
                                    $firstRow = "[Date.UTC($year, $month, $newDay), 0 ],";
                                }
                            }
                            echo $firstRow.$output;
                            ?>
                        ]
                    }]
            });
        });

    </script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
</section>