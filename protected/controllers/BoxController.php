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
        $criteria->with = array('customer','totalSold');
        $newBoxes = Item::model()->latest(10)->findAll($criteria);
        
        $this->render('new',array('newBoxes'=>$newBoxes));
    }

    //Ranking Page Sorted by Top Rank
    public function actionRanking() {
        $topBoxes = Item::rankedItems();
        $this->render('ranking',array('topBoxes'=>$topBoxes));
    }

    //Ranking Page Sorted by Trending
    public function actionTrending() {
        $trendingBoxes = Item::trendingItems(1,10);
        $this->render('trending',array('trendingBoxes'=>$trendingBoxes));
    }

    //Box Inner Page
    public function actionView() {
        $this->render('view');
    }
}