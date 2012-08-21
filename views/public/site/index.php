<?php $this->pageTitle = Yii::app()->name; ?>
<div id="top_home">
    <div id="th_left">
        <ul>
            <li id="dhcoban"><?php echo CHtml::link('', $this->createUrl('/training/list',array('tid'=>1))); ?></li>
            <li id="dhnangcao"><?php echo CHtml::link('', $this->createUrl('/training/list',array('tid'=>2))); ?></li>
            <li id="gtcoban"><?php echo CHtml::link('', $this->createUrl('/training/list',array('tid'=>3))); ?></li>
            <li id="gtnangcao"><?php echo CHtml::link('', $this->createUrl('/training/list',array('tid'=>4))); ?></li>
        </ul>
        <?php echo CHtml::link('xem thêm &raquo;',$this->createUrl('/training/index'),array('style'=>'float:right;color:#2db5dc;margin-right:20px;text-decoration:none')); ?>
        <p style="margin-bottom: 5px;;color: #000;font-weight: bold;clear:both;">Học viên tiêu biểu</p>
        <ul id="tieubieu">
            <li><?php echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/hocvientieubieu_22.jpg" />', $this->createUrl('/')); ?></li>
            <li style="margin-left:5px;"><?php echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/hocvientieubieu_24.jpg" />', $this->createUrl('/')); ?></li>
            <li style="margin-left:5px;"><?php echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/tieubieu_26.jpg" />', $this->createUrl('/')); ?></li>
            <li style="margin-left:5px;"><?php echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/hocvientieubieu_27.jpg" />', $this->createUrl('/')); ?></li>
        </ul>
    </div>
    <div id="th_right">
        <div id="th_ringht_inner">
            <div id="slide">
                <?php $this->widget('SlideShow'); ?>
				<?php //$this->widget('Playslide'); ?>
            </div>
        </div>
    </div>
</div>
<div id="center_home">
    <div class="list_home clearfix">
        <div class="tieude">Thư viện ứng dụng</div>
        <?php
        
        if(isset($appItems) && $appItems){
            $i=1;
            $u=1;
            foreach($appItems as $aitem){
                if($i==2){
                    $u = 3;
                }elseif($u==3){
                    $u= 1;
                }
                else{
                    $u++;
                }
                $divClass ='item';
                if($u == 3){
                    $divClass .= ' citem';
                }else{

                }

                if($i>3){
                    $divClass .= ' mtop';
                }
                //var_dump(Lnt::getYoutubeImage($aitem['youtube']));die;
                echo CHtml::openTag("div",array("class"=>$divClass));
                $imagPath = Yii::getPathOfAlias('webroot') . '/' . $aitem['image'];
                if(is_file($imagPath))
                    echo CHtml::image(Lnt::createImage($aitem['image'],105,70));
                else
                    echo CHtml::image(Lnt::getYoutubeImage($aitem['youtube']));
                    //echo Lnt::getYoutubeImage($aitem['youtube']);

                echo CHtml::openTag("div",array('class'=>'title'));
                echo CHtml::link(Lnt::limitWord($aitem['title'],8),$aitem['url'],array('title'=>$aitem['title']));
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('class'=>'author'));
                echo CHtml::link($aitem['username'],$this->createUrl('/user/view',array('username'=>$aitem['username'])));
                echo CHtml::closeTag("div");
                echo CHtml::closeTag("div");
                $i++;
            }
        }
        ?>
    </div>
    <div class="list_home clearfix" style="margin-top: 15px">
        <div class="tieude">vui chơi - giải trí</div>
        <?php

        if(isset($newsItems) && $newsItems){
            $i=1;
            $u=1;
            foreach($newsItems as $item){
                if($i==2){
                    $u = 3;
                }elseif($u==3){
                    $u= 1;
                }
                else{
                    $u++;
                }
                $divClass ='item';
                if($u == 3){
                    $divClass .= ' citem';
                }else{

                }

                if($i>3){
                    $divClass .= ' mtop';
                }
                echo CHtml::openTag("div",array("class"=>$divClass));
                echo CHtml::image(Lnt::createImage($item['image'],105,70));
                echo CHtml::openTag("div",array('class'=>'title'));
                echo CHtml::link(Lnt::limitWord($item['title'],8),$item['url'],array('title'=>$item['title']));
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('class'=>'author'));
                echo CHtml::link($item['username'],$this->createUrl('/user/view',array('username'=>$item['username'])));
                echo CHtml::closeTag("div");
                echo CHtml::closeTag("div");
                $i++;
            }
        }
        /*$this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'id' => 'newest_video',
            'enablePagination'=>false,
            'summaryText'=>'Dịch vụ giải trí',
            //'template' => "{items}\n{pager}",
        ));*/
        ?>
    </div>
</div>
<div id="bottom_home">
    <div class="title">DỊCH VỤ</div>
    <ul>
        <li id="goisp"><?php echo CHtml::link('', $this->createUrl('/')); ?></li>
        <li id="bannhac"><?php echo CHtml::link('', $this->createUrl('/')); ?></li>
        <li id="giasu"><?php echo CHtml::link('', $this->createUrl('/')); ?></li>
        <li id="dathang"><?php echo CHtml::link('', $this->createUrl('/product/index')); ?></li>
    </ul>
</div>