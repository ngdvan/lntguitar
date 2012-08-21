<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('body')); ?>:
	<?php echo GxHtml::encode($data->body); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('province_id')); ?>:
	<?php echo GxHtml::encode($data->province_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('district_id')); ?>:
	<?php echo GxHtml::encode($data->district_id); ?>
	<br />

</div>