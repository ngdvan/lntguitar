<?php
/**
 * @var $this CController
 */
$this->pageTitle = Yii::app()->name.' - '.$page->title;
?>
<h1><?php echo $page->title; ?></h1>
<div style="text-align: justify;">
    <?php echo $page->body; ?>
</div>
