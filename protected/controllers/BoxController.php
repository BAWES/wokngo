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
        $newBoxes = Item::model()->latest(20)->findAll($criteria);
        
        $this->render('new',array('newBoxes'=>$newBoxes));
    }

    //Ranking Page Sorted by Top Rank
    public function actionRanking() {
        $topBoxes = Item::rankedItems();
        $this->render('ranking',array('topBoxes'=>$topBoxes));
    }

    //Ranking Page Sorted by Trending
    public function actionTrending() {
        $this->render('trending');
    }

    //Box Inner Page
    public function actionView() {
        $this->render('view');
    }
}