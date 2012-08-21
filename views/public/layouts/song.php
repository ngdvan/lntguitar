<?php $this->beginContent('//layouts/main'); ?>
<div id="top"></div>
<div id="content" class="clearfix">
    <div class="span-17">
        <?php echo $content; ?>
    </div>
    <!-- content -->
    <div class="span-6 last">
        <?php
        $this->widget('SongFilter');
        $this->widget('NewestSong');
        ?>

    </div>
</div>
<div id="bottom"></div>
<?php $this->endContent(); ?>