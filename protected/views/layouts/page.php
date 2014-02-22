<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<header id='page'>
    <h1><?php echo $this->pageHeader; ?></h1>
</header>

<section id="pageContent">
    <?php echo $content; ?>
</section>
<?php $this->endContent(); ?>