<?php $this->pageTitle = $hopam->title . ' - ' . $hopam->ban_artist . ' | Thư viện hợp âm'; ?>
<div class="span-17">
    <script type="text/javascript">
        $(document).ready(function () {
            $('.tab').click(function () {
                var tab = $(this).text();
                $("u").each(function () {
                    //alert($(this).attr("value"));
                    if ($(this).attr("value") != tab) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
                $(this).css('color', '#ed2480');
                return false;
            });

            $('.all_tab').click(function () {
                $("u").each(function () {
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
        echo $hopam->title . ' - ' . $hopam->ban_artist;
        ?></h1>
    <?php if ($hopam->embed_code) : ?>
    <div class="embed" style="background: none;">
        <?php
        echo $hopam->embed_code;
        ?>
    </div>
    <?php endif; ?>
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
        <div>Ca sĩ/Ban nhạc: <span style="color: #2DB5DC"><?php echo $hopam->ban_artist; ?></span></div>
        <div>Tags:<?php echo implode(', ', $hopam->tagLinks); ?></div>
    </div>
    <?php
//echo $hopam->lyrics;
    $l = new GuitarTabs();
    $l->key = $key;
    $l->add_section('', $hopam->lyrics);
    ?>
    <div class="lyric">
        <div style="display: inline;clear: both;">
            <div class="title"
                 style="width: 20%;float: left;font-size: 18px;color: #231f20;font-weight: normal;font-family: 'TIMES NEW ROMAN'">
                Lời bài hát
            </div>
            <div class="hopam_tab"
                 style="width: 80%;float: left;color: #000;font-size: 18px;font-family: 'TIMES NEW ROMAN'">
            </div>
        </div>
        <div class="guitar_tab" style="clear: both;">
            <?php
            $l->print_fixed2();
//            var_dump($l->tabs);
            ?>
        </div>
    </div>
    <div class="comment">
        <?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
        <?php else: ?>
        <?php $this->renderPartial('/comment/_form', array(
            'comment' => $comment,
        )); ?>
        <?php endif; ?>
        <?php if ($hopam->commentCount >= 1): ?>
        <?php $this->renderPartial('/comment/_comments', array(
            'video' => $hopam,
            'comments' => $hopam->hopamComments,
        )); ?>
        <?php endif; ?>
        <div class="comment_list">

        </div>
    </div>
    <div style="margin-top: 20px" class="comment">
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'lntguitarschool'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function () {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#cont").transpose();
        var chordsList = [<?php echo '"' . implode('","', $chord_list) . '"'; ?>];
        $(this).chordsLoad(chordsList);
    });
</script>
<!-- content -->
<div class="span-6 last">
    <?php
    $this->widget('BoxProfile', array('user' => $hopam->user));
    $this->widget('NewestHopam');
    ?>

</div>



