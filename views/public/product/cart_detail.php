<?php
$this->breadcrumbs=array(
		'Mua nhạc cụ'=>array('index'),
		'Giỏ hàng'=>array('cart'),
		'Đặt hàng'
);
$total = 0;
?>
<h1 class="title">Thông tin chi tiết đơn hàng</h1>
<p class="hint">Vui lòng xem thông tin đơn hàng bên dưới. Nếu có thông tin sai sót nhấn vào nút <b>Quay lại</b> để sửa. Nhấn vào nút <b>Đặt hàng</b> để tiến hành gửi đơn đặt hàng.</p>
<table>
<thead>
<tr><th>Sản phẩm</th></tr>
</thead>
<?php foreach($items as $item):?>
<?php $total += $item['item']->price*$item['count'];?>
<tr><td style="border-bottom:1px solid #ccc;">
- <b><?php echo $item['item']->title;?></b><br/>
- Số lượng: <?php echo $item['count'];?><br/>
- Thành tiền: <span style="text-align:center;color:#990000;font-weight: bold;"><?php echo number_format($item['item']->price*$item['count'],0,',','.');?> đ</span><br/>
</td></tr>
<?php endforeach;?>
<tr><td>Tổng tiền: <span style="text-align:center;color:#990000;font-weight: bold;"><?php echo number_format($total,0,',','.');?> đ</span></td></tr>
</table>
<table>
<thead>
<tr><th>Thông tin khách hàng</th></tr>
</thead>
<tr><td>Họ tên: <?php echo $customer->name?><br/>
Điện thoại: <?php echo $customer->tel?><br/>
Email: <?php echo $customer->email?><br/>
Địa chỉ: <?php echo $customer->address?><br/>
</td></tr>
</table>
<?php echo CHtml::button('',array('onclick'=>'javascript:history.go(-1);','id'=>'btBack'));?>
<?php echo CHtml::button('',array('onclick'=>'javascript:window.location = "'.$this->createUrl('complete').'"','id'=>'btOrder'));?>
<!--<div class="right">
<?php
/*    $this->beginWidget('zii.widgets.CPortlet', array(
        'title' => 'Danh mục đàn',
        'id'=>'box-video-channel'
    ));
    $this->widget('ProductCatList');
    $this->endWidget();
    */?>

</div>-->