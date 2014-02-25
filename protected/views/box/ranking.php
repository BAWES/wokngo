<?php
/* @var $this BoxController */

$this->pageTitle = Yii::app()->name . ' - Top Wokers';
?>


<header id='ranking'>
    <h1>Top Wokers</h1>
    <h2>Search Boxes</h2>
    <form method='get'>
        <select id='type' name='type'>
            <option value='top' selected='selected'>Top Wokers</option>
            <option value='trending'>Trending Wokers</option>
            <option value='new'>New Wokers</option>
        </select>
        <input type='text' id='keyword' name='keyword' placeholder='Enter keyword...'/>
        <a href='#search'>Search</a>
    </form>
</header>

<section id='rankingList'>
    <!-- Start Listing Boxes -->

    <a href='box.html'>
        <b>1</b>
        <div class='img'><img src='images/layout/defaultbox.jpg' alt='Box Image'/></div>
        <div class='boxDetails'>
            <h3>Box Name Goes Here...</h3>
            <h4>Heather Soto</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua...
            </p>
        </div>
        <div class='numSold'>
            30 <span>Boxes Sold</span>
        </div>
        <div class='clear'></div>
    </a>

    <br/>
</section>