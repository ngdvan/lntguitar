<div class="span-17">
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tab').click(function(){
                var tab  = $(this).text();
                $("u").each(function(){
                    //alert($(this).attr("value"));
                    if($(this).attr("value") != tab){
                        $(this).hide();
                    }else{
                        $(this).show();
                    }
                });
                $(this).css('color','#ed2480');
                return false;
            });

            $('.all_tab').click(function(){
                $("u").each(function(){
                    $(this).show();
                });
                return false;
            });
        });
    </script>
    <h1><?php
        /**
         * @var $hopam Hopam
         */
        echo $hopam->title;
        ?></h1>
    <div class="embed" style="background: none;">
        <?php
        echo $hopam->embed_code;
        ?>
    </div>
    <div class="video_info clearfix" style="width: 660px;margin-top: 12px;">
        <div class="fan">
            <?php
            echo CHtml::ajaxButton('', $this->createUrl('like', array('id' => $hopam->id)), array('success' => 'js:function(res){alert(res.msg);}'), array('class' => 'fan_like'));
            echo CHtml::button('', array('class' => 'fan_share'));
            echo CHtml::ajaxButton('', '', null, array('class' => 'fan_alert'));
            ?>

        </div>
        <div class="video_count" style="width: 50%;text-align: right;float: left;">
            <div style="font-size: 20px;color: #000;">
                <?php echo number_format($hopam->view, 0, '.', ','); ?>
            </div>
            <div><b><?php echo $hopam->likeCount; ?></b> yêu thích</div>
        </div>
    </div>
    <div id="share_box" class="view clearfix" style="display: none;">
        <ul>
            <li>
                <span>Link nhạc:</span>
                <input
                    value="<?php echo Lnt::WEB . Yii::app()->baseUrl . $this->createUrl('view', array('id' => $hopam->id, 'title' => Lnt::safeTitle($hopam->title))); ?>"
                    class="text">
            </li>
            <li>
                <span>Nhúng:</span>
                <textarea class="text" cols="63"><?php echo CHtml::encode($hopam->embed_code); ?></textarea>
            </li>
        </ul>
    </div>
    <div class="user_info">
        <div>Người
            gửi: <?php echo CHtml::link($hopam->user->username, Yii::app()->createUrl('user/view', array('username' => $hopam->user->username))) ?></div>
<!--        <div>Người hướng dẫn: <span style="color: #2DB5DC">--><?php //echo $hopam->guider; ?><!--</span> </div>-->
<!--        <div>Tags:--><?php //echo implode(', ', $hopam->tagLinks); ?><!--</div>-->
    </div>
    <?php
//echo $hopam->lyrics;
    $l = new GuitarTabs();
    $l->add_section('', $hopam->lyrics);
    ?>
    <div class="lyric">
        <div style="display: inline;clear: both;">
            <div class="title" style="width: 50%;float: left;font-size: 18px;color: #231f20;font-weight: normal;font-family: 'TIMES NEW ROMAN'">Lời bài hát </div>
            <div class="hopam_tab" style="width: 50%;float: left;color: #000;font-size: 18px;font-family: 'TIMES NEW ROMAN'">Key: <?php echo CHtml::link('Tất cả','#',array('class'=>'all_tab')); ?> <span style='color: #a7a7a7'>|</span> <?php echo $l->objTabs(); ?></div>
        </div>
        <div class="guitar_tab" style="clear: both;font-style: italic;">
            <?php
            $l->print_fixed2();
            ?>
        </div>
    </div>
    <!--<div class="comment">
        <?php /*if (!Yii::app()->user->isGuest) { */?>
        <?php /*if (Yii::app()->user->hasFlash('commentSubmitted')): */?>
            <div class="flash-success">
                <?php /*echo Yii::app()->user->getFlash('commentSubmitted'); */?>
            </div>
            <?php /*else: */?>
            <?php /*$this->renderPartial('/comment/_form', array(
                'comment' => $comment,
            )); */?>
            <?php /*endif; */?>
        <?php
/*    } else {
        echo CHtml::link('Đăng nhập',$this->createUrl('/site/login'))." để đăng bình luận";
        */?>

        <?php /*} */?>
        <?php /*if ($hopam->commentCount >= 1): */?>
        <?php /*$this->renderPartial('/comment/_comments', array(
            'video' => $hopam,
            'comments' => $hopam->hopamComments,
        )); */?>
        <?php /*endif; */?>
        <div class="comment_list">

        </div>
    </div>-->
</div>
<!-- content -->
<div class="span-6 last">
    <?php
    $this->widget('BoxProfile', array('user' => $hopam->user));
    $this->widget('NewestSong');
    ?>

</div>



