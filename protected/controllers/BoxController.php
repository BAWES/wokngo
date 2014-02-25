<?php

class BoxController extends Controller {

    public function actionIndex() {
        //redirect to ranking page 
        $this->redirect(array('ranking'));
    }

    //Ranking Page Sorted by Latest
    public function actionNew() {
        $this->render('new');
    }

    //Ranking Page Sorted by Top Rank
    public function actionRanking() {
        
        
        $this->render('ranking');
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