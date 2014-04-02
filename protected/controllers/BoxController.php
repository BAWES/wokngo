<?php

class BoxController extends Controller {

    public function actionIndex() {
        //redirect to ranking page 
        $this->redirect(array('ranking'));
    }

    //MONITOR:: Ranking Page Sorted by Latest
    public function actionMonitorNew($refresh = false) {
        //New Boxes
        $criteria = new CDbCriteria();
        $criteria->with = array('customer', 'totalSold');
        $newBoxes = Item::model()->latest(10)->findAll($criteria);

        if ($refresh) {
            $i = 0;
            $output = "";
            foreach ($newBoxes as $box) {
                $i++;

                $output .= "

                        <a href='#'>
                            <b>$i</b>
                            <div class='img'><img src='" . $box->image . "' alt='" . $box->item_name . "'/></div>
                            <div class='boxDetails'>
                                <h3>" . $box->item_name . "</h3>
                                <h4>" . $box->customer->customer_name . "</h4>
                            </div>
                            <div class='numSold'>
                                " . (int) $box->totalSold . " <span>Boxes Sold</span>
                            </div>
                            <div class='clear'></div>
                        </a>
                        ";
            }
            echo $output . " <br style='clear:both;'/>";
        }
        else
            $this->renderPartial('monitorNew', array('newBoxes' => $newBoxes));
    }

    //MONITOR::Ranking Page Sorted by Top Rank
    public function actionMonitorRanking($refresh = false) {
        $topBoxes = Item::rankedItems();

        if ($refresh) {
            $i = 0;
            $output = "";
            foreach ($topBoxes as $box) {
                if($i == 10) break;
                
                $i++;

                if ($box['item_image'] == null) {
                    $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/default.jpg";
                } else {
                    $box['item_image'] = Yii::app()->request->baseUrl . "/images/box/" . $box['item_image'];
                }

                $output .= "

                        <a href='#'>
                            <b>$i</b>
                            <div class='img'><img src='" . $box['item_image'] . "' alt='" . $box['item_name'] . "'/></div>
                            <div class='boxDetails'>
                                <h3>" . $box['item_name'] . "</h3>
                                <h4>" . $box['customer_name'] . "</h4>
                            </div>
                            <div class='numSold'>
                                " . (int) $box['sales'] . " <span>Boxes Sold</span>
                            </div>
                            <div class='clear'></div>
                        </a>
                        ";
            }
            echo $output . " <br style='clear:both;'/>";
        }
        else
            $this->renderPartial('monitorRanking', array('topBoxes' => $topBoxes));
    }
    
    //Ranking Page Sorted by Trending
    public function actionMonitorTrending($refresh = false) {
        $trendingBoxes = Item::trendingItems(1, 10);
        
        if ($refresh) {
            $i = 0;
            $output = "";
            foreach ($trendingBoxes as $box) {
                if($i==10) break;
                $i++;

                $output .= "

                        <a href='#'>
                            <b>$i</b>
                            <div class='img'><img src='" . $box->image . "' alt='" . $box->item_name . "'/></div>
                            <div class='boxDetails'>
                                <h3>" . $box->item_name . "</h3>
                                <h4>" . $box->customer->customer_name . "</h4>
                            </div>
                            <div class='numSold'>
                                " . (int) $box->totalSold . " <span>Boxes Sold</span>
                            </div>
                            <div class='clear'></div>
                        </a>
                        ";
            }
            echo $output . " <br style='clear:both;'/>";
        }else $this->renderPartial('monitorTrending', array('trendingBoxes' => $trendingBoxes));
    }

    //Ranking Page Sorted by Latest
    public function actionNew() {
        //New Boxes
        $criteria = new CDbCriteria();
        $criteria->with = array('customer', 'totalSold');
        $newBoxes = Item::model()->latest(10)->findAll($criteria);

        $this->render('new', array('newBoxes' => $newBoxes));
    }

    //Ranking Page Sorted by Top Rank
    public function actionRanking() {
        $topBoxes = Item::rankedItems();
        $this->render('ranking', array('topBoxes' => $topBoxes));
    }

    //Ranking Page Sorted by Trending
    public function actionTrending() {
        $trendingBoxes = Item::trendingItems(1, 10);
        $this->render('trending', array('trendingBoxes' => $trendingBoxes));
    }

    //Search functionality
    public function actionSearch($keyword = '') {
        $criteria = new CDbCriteria();
        $criteria->condition = "item_name LIKE :boxName";
        $criteria->params = array(':boxName' => '%' . trim($keyword) . '%');
        $criteria->limit = 10;

        $boxResults = Item::model()->findAll($criteria);

        $this->render('search', array('boxResults' => $boxResults, 'keyword' => $keyword));
    }

    //Box Inner Page
    public function actionView($seo) {
        $seo = strtolower($seo);
        $seo = preg_replace("/[^a-z0-9_\s-]/", "", $seo);
        $seo = preg_replace("/[\s-]+/", " ", $seo);
        $seo = preg_replace("/[\s_]/", "-", $seo);

        $criteria = new CDbCriteria();
        $criteria->with = array('customer', 'sales', 'totalSold');
        $box = Item::model()->findByAttributes(array('item_seo_name' => $seo), $criteria);
        if ($box == null)
            throw new CHttpException(404, "Box '$seo' could not be found.");

        //Find ingredients that match this box
        $dbCriteria = new CDbCriteria();
        foreach (explode(",", $box->item_ingredients) as $ingredient) {
            $dbCriteria->compare('ingredient_match_name', trim($ingredient), true, 'OR');
        }
        $ingredients = Ingredient::model()->findAll($dbCriteria);

        /* Get Sales Grouped by Date */
        $query = Yii::app()->db->createCommand();
        $query->select('date(sale_datetime) as date, sum(sale_quantity) as quantity');
        $query->from('sale');
        $query->where('item_id=:id', array(':id' => $box->item_id));
        $query->group('date');
        $query->order('date');
        $sales = $query->queryAll();

        $this->render('view', array('box' => $box, 'ingredients' => $ingredients, 'sales' => $sales));
    }

}