<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('code')); ?>:
	<?php echo GxHtml::encode($data->code); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mpn_code')); ?>:
	<?php echo GxHtml::encode($data->mpn_code); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('price')); ?>:
	<?php echo GxHtml::encode($data->price); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('video')); ?>:
	<?php echo GxHtml::encode($data->video); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('teach_info')); ?>:
	<?php echo GxHtml::encode($data->teach_info); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('body')); ?>:
	<?php echo GxHtml::encode($data->body); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cat_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->cat)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('th_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->th)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('count_buy')); ?>:
	<?php echo GxHtml::encode($data->count_buy); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>