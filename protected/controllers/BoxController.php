<?php

class BoxController extends Controller {

    public function actionIndex() {
        //redirect to ranking page 
        $this->redirect(array('ranking'));
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
        foreach (explode(",",$box->item_ingredients) as $ingredient) {
            $dbCriteria->compare('ingredient_match_name', trim($ingredient), true, 'OR');
        }
        $ingredients = Ingredient::model()->findAll($dbCriteria);

        $this->render('view', array('box' => $box, 'ingredients'=>$ingredients));
    }

}