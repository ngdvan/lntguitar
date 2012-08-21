<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('body')); ?>:
	<?php echo GxHtml::encode($data->body); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('picture')); ?>:
	<?php echo GxHtml::encode($data->picture); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('like_count')); ?>:
	<?php echo GxHtml::encode($data->like_count); ?>
	<br />

</div>