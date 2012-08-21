<div class="ptop">
    <div class="embed" style="width:565px;float:left;">
        <?php
        $url = $item->video;
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
        <iframe width="565" height="315" src="http://www.youtube.com/embed/<?php echo $str; ?>" frameborder="0"
                allowfullscreen></iframe>
    </div>
    <div class="info">
        <div style="font-size: 18px; font-weight: bold;color: #000;">
            <?php
            echo $item->title;
            ?>
        </div>
        <div style="color: #747474;margin-top: 10px;">
            <?php echo "Code:" . $item->code; ?><br/>
            <?php echo "MPN code: " . $item->mpn_code; ?>
        </div>
        <div style="color: #000;font-size: 18px;margin: 10px 0px;">
            <?php echo number_format($item->price,0,",","."); ?>đ
        </div>
        <div style="color: #fc217f;">
            Còn hàng
        </div>
        <div style="margin: 10px 0px">
            <?php
            echo CHtml::ajaxButton("", $this->createUrl('addcart',array('id'=>$item->id)),array('success'=>'js:function(data){
				if(data.success){window.location = "'.$this->createUrl('cart').'"}
															}'),array('id'=>'btn_buy'));
            //echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/datmua.jpg'));
            ?>
        </div>
        <div style="margin: 10px 0px;">
            <p style="margin-bottom: 10px;padding: 0;">Thanh toán an toàn qua:</p>
            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/thanhtoanqua.jpg'); ?>
        </div>
        <div>
            <p style="font-size: 18px; font-weight: bold;color: #000;margin-bottom: 10px;">Thông số kỹ thuật</p>
            <?php echo $item->teach_info; ?>
        </div>
    </div>
</div>
<div class="pbottom">
<h1 class="title">Chi tiết sản phẩm</h1>
    <div>
        <?php echo $item->body; ?>
    </div>
<h1 class="title">Sản phẩm liên quan</h1>
    <ul class="banchay">
        <?php
        Yii::import('application.extensions.image.Image');
        $i = 1;

        foreach ($relatedItems as $item) {
            $class = 'item';
            if ($i == 1 | ($i % 6 == 1)) {
                $class .= ' first';
            } elseif ($i % 6 == 0) {
                $class .= ' last';
            }
            $i++;
            //var_dump($item);die;
            $thumb = new Image(Yii::getPathOfAlias('webroot') . $item['image']);
            $img_url = $thumb->createThumb(140, 195);
            echo CHtml::openTag("li", array('class' => $class));
            echo CHtml::link(CHtml::image($img_url), $this->createUrl('view', array('id' => $item['id'], 'title' => Lnt::safeTitle($item['title']))));
            echo CHtml::openTag("div", array('class' => 'title'));
            echo CHtml::encode($item['title']);
            echo CHtml::closeTag("div");
            echo CHtml::openTag("div", array('class' => 'price'));
            echo CHtml::encode(number_format($item['price'], 0, ',', '.') . 'đ');
            echo CHtml::closeTag("div");

            echo CHtml::openTag("div", array('class' => 'body'));
            echo Lnt::limitWord($item['body'], 10, ',', '.');
            echo CHtml::closeTag("div");
            echo CHtml::closeTag("li");

        }
        ?>
    </ul>
</div>
