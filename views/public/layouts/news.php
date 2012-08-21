<?php $this->beginContent('//layouts/main'); ?>
<div id="top"></div>
<div id="content" class="clearfix">
    <div class="span-17">
        <?php echo $content; ?>
    </div>
    <!-- content -->
    <div class="span-6 last">
        <?php
        $tid = null;
        if(isset($_GET['tid'])){
            $tid = $_GET['tid'];
        }
        $id = null;
        if(isset($_GET['id']))
            $id = $_GET['id'];
        $this->widget('OtherNews',array('catId'=>$tid,'currentId'=>$id));
        ?>

    </div>
</div>
<div id="bottom"></div>
<?php $this->endContent(); ?>