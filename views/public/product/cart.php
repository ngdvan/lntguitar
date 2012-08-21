<?php
$this->breadcrumbs=array(
		'Mua nhạc cụ'=>array('/product'),
		'Giỏ hàng',
);

?>
<script type="text/javascript">
function updateCart(id,obj)
{
	var countItem = $(obj).val();
	var url = '<?php echo $this->createUrl('changenum')?>';
	$.ajax({
			url:url,
			data:'id='+id+'&count='+countItem,
			dataType: 'json',
			success:function(){
				window.location.reload();
				}
		});
}
</script>
<div class="grid-view">
	<h1 class="title">Giỏ hàng</h1>
	<table class="cart items" style="margin-top: 20px;">
		<thead>
			<tr>
				<th style="width: 5%;">STT</th>
				<th style="width:10%;">Ảnh</th>
				<th style="width:45%;">Tên sản phẩm</th>
				<th style="text-align: center;width:15%">Giá (Vnđ)</th>
				<th style="width: 15%;">Số lượng</th>
				<th style="width: 5%;"></th>
			</tr>
		</thead>
        <tbody>
		<?php
		if($items)
		{
			$total_price = 0;
			$i = 0;
            Yii::import('application.extensions.image.Image');
			foreach($items as $item)
			{

				$product = $item['item'];
				$total_price += $product->price * $item['count'];
				$thumb = '';
				if($product->image){
					/*$thumb = '/upload/images/thumb/product100/'.substr_replace($product->image,'',0,14);
					if(!is_file(Yii::getPathOfAlias('webroot').$thumb)){
						Yii::import('application.extensions.image.Image');
						$image = new Image(Yii::getPathOfAlias('webroot').'/'.$product->image);
						$image->resize(100, 100);
						if(!is_dir(Yii::getPathOfAlias('webroot').'/upload/images/thumb/product100/')){
							mkdir(Yii::getPathOfAlias('webroot').'/upload/images/thumb/product100/');
							chmod(Yii::getPathOfAlias('webroot').'/upload/images/thumb/product100/',0777);
						}
						$image->save(Yii::getPathOfAlias('webroot').$thumb);
					}*/
				}

				$i++;
                $img = new Image(Yii::getPathOfAlias("webroot").$product->image);
                $img_url = $img->createThumb(70,70);
				echo "<tr><td>{$i}</td><td><div style='float:left;border: 1px solid #CCCCCC;padding:5px;margin-right:5px;'><a href='".$this->createUrl('product/view',array('id'=>$product->id,'title'=>Lnt::safeTitle($product->title)))."' target='_blank'><img src='".$img_url."' /></a></div></td><td><div>{$product->title}</div></td><td><div style='text-align:center;color:#990000;font-weight: bold;'>".number_format($product->price * $item['count'],0,',','.')." đ</div></td><td>".CHtml::listBox('price', $item['count'], array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10),array('size'=>1,'onchange'=>'updateCart('.$product->id.',this);'))."</td><td>".CHtml::ajaxLink('Xóa', $this->createUrl('remove',array('id'=>$product->id)), array('success'=>'js:function(data){if(data.success){window.location.reload();}}'))."</td></tr>";
			}
			?>

		<tr><td colspan="3" ><?php echo CHtml::link('', $this->createUrl('index'),array('id'=>'btnbackBuy')); ?><span style="float:right;font-weight: bold;">Tổng tiền:</span></td><td style="text-align:center;color:#990000;font-weight: bold;"><?php echo number_format($total_price,0,',','.');?> đ</td><td colspan="2"><?php echo CHtml::link("",$this->createUrl('pay'),array('id'=>'btnPay'));?></td></tr>
		<?php 	
		}else{
			echo "<tr><td colspan='5'>Không có sản phẩm nào</td></tr>";
		}
		?>
        </tbody>
	</table>
</div>


