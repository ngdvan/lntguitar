<?php $this->beginContent('//layouts/main'); ?>
<div id="top"></div>
<div id="content" class="clearfix">
    <div class="span-17">
        <?php echo $content; ?>
    </div>
    <!-- content -->
    <div class="span-6 last">
        <?php
        if (Yii::app()->controller->id == 'video') {
            $this->widget('VideoFilter');
            $this->widget('VideoTagCloud', array(
                'maxTags' => Yii::app()->params['videoTagCloudCount'],
                'htmlOptions' => array('class' => 'portlet', 'id' => 'videotagcloud')
            ));

            echo "<div style='margin-top:15px;'><img src='".Yii::app()->baseUrl."images/dk_gv_03.jpg'/></div>";
        }elseif(Yii::app()->controller->id == 'teacher'){
            $this->widget('BoxTeacher');
            echo "<div style='margin-top:15px;'><img src='".Yii::app()->baseUrl."images/cosogiangday_03.jpg'/></div>";
        }
        ?>

    </div>
</div>
<div id="bottom"></div>
<?php $this->endContent(); ?>