<?php $this->beginContent('//layouts/main'); ?>
<div id="top"></div>
<div id="content" class="clearfix">
    <div class="span-17">
        <?php echo $content; ?>
    </div>
    <!-- content -->
    <div class="span-6 last">
        <?php
        $this->widget('VideoFilter');
        $this->widget('VideoTagCloud', array(
            'maxTags' => Yii::app()->params['videoTagCloudCount'],
            'htmlOptions' => array('class' => 'portlet', 'id' => 'videotagcloud')
        ));
        $this->widget('VideoCategories');
        echo "<div style='margin-top:15px;'><a href='/forum/login.php'><img src='" . Yii::app()->baseUrl . "/images/dk_gv_03.jpg'/></a></div>";

        ?>

    </div>
</div>
<div id="bottom"></div>
<?php $this->endContent(); ?>