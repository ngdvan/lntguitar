<?php $this->beginContent('//layouts/main'); ?>
<div id="top"></div>
<div id="content" class="clearfix">
    <div class="span-17">
        <?php echo $content; ?>
    </div>
    <!-- content -->
    <div class="span-6 last">
        <?php
        
        echo "<div style='margin-top:15px;'><img src='".Yii::app()->baseUrl."/images/cosogiangday_03.jpg'/></div>";
        echo "<div style='margin-top:15px;'><img src='".Yii::app()->baseUrl."/images/adv.png'/></div>";
        ?>

    </div>
</div>
<div id="bottom"></div>
<?php $this->endContent(); ?>