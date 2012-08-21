<?php foreach($comments as $comment): ?>
<div class="comment_item clearfix" id="c<?php echo $comment->id; ?>">
    <div id="comment_avatar">
<!--        <img src="--><?php //echo Yii::app()->baseUrl . '/images/avatar.jpg'?><!--"/>-->
        <img width="60" height="60" src="<?php echo Lnt::get_picture_href($comment->user->user_id) ;?>"/>
    </div>
    <div id="comment_item_content">
        <div class="author">
            <span style="color: #2db5dc;"><?php echo CHtml::link($comment->user->username,$this->createUrl('user/view',array('username'=>$comment->user->username))); ?></span>
            <span style="color: #a7a7a7;"><?php echo date('d/m/Y h:i',$comment->create_time); ?></span>
        </div>
        <div class="content" style="color: #000;">
            <?php echo nl2br(CHtml::encode($comment->contents)); ?>
        </div>
    </div>

</div><!-- comment -->
<?php endforeach; ?>