<?php
$this->pageTitle = $video->title.' - '.Yii::app()->name."";
?>
<h1><?php
    /**
     * @var $video Video
     */
    echo $video->title;
    ?></h1>
<div class="embed">
    <?php
    $url = $video->link_youtube;
    $url = substr($url, strpos($url, '?') + 1, strlen($url));
    $arr = explode("&", $url);
    $str = "";
    if ($arr) {
        foreach ($arr as $param) {
            if (preg_match('/^v=/i', $param)) {
                $str = $param;
            }
        }
    }
    $str = substr($str, 2, strlen($str));
    ?>
    <iframe width="640" height="360" src="http://www.youtube.com/embed/<?php echo $str; ?>" frameborder="0"
            allowfullscreen></iframe>
</div>
<div class="video_info clearfix" style="width: 660px;margin-top: 12px;">
    <div class="fan">
        <?php
        echo CHtml::ajaxButton('', $this->createUrl('like', array('id' => $video->id)), array('success' => 'js:function(res){alert(res.msg);}'), array('class' => 'fan_like'));
        echo CHtml::button('', array('class' => 'fan_share'));
        echo CHtml::ajaxButton('', '', null, array('class' => 'fan_alert'));
        ?>

    </div>
    <div class="video_count" style="width: 50%;text-align: right;float: left;">
        <div style="font-size: 20px;color: #000;">
            <?php echo number_format($video->view, 0, '.', ','); ?>
        </div>
        <div><b><?php echo $video->likeCount; ?></b> yêu thích</div>
    </div>
</div>
<div id="share_box" class="view clearfix" style="display: none;">
    <ul>
        <li>
            <span>Link nhạc:</span>
            <input
                value="<?php echo Lnt::WEB . Yii::app()->baseUrl . $this->createUrl('view', array('nid' => $video->id, 'title' => Lnt::safeTitle($video->title))); ?>"
                class="text">
        </li>
        <li>
            <span>Copy vào blog:</span>
            <input value="<?php echo $video->link_youtube; ?>" class="text">
        </li>
    </ul>
</div>
<div class="user_info">
    <div>Người
        gửi: <?php echo CHtml::link($video->user->username, Yii::app()->createUrl('user/view', array('username' => $video->user->username))) ?></div>
    <div>Người hướng
        dẫn: <?php echo CHtml::link($video->teacher->name, Yii::app()->createUrl('user/view', array('username' => $video->teacher->username))); ?></div>
    <div>Tags:<?php echo implode(', ', $video->tagLinks); ?></div>
</div>
<div class="lyric">
    <div class="title">Lời bài hát</div>
    <div class="body">
        <?php echo $video->body; ?>
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
    <?php if ($video->commentCount >= 1): ?>
    <?php $this->renderPartial('/comment/_comments', array(
        'video' => $video,
        'comments' => $video->videoComments,
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
