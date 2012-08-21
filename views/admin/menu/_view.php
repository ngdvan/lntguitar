<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('sort')); ?>:
	<?php echo GxHtml::encode($data->sort); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent')); ?>:
	<?php echo GxHtml::encode($data->parent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('router')); ?>:
	<?php echo GxHtml::encode($data->router); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('url')); ?>:
	<?php echo GxHtml::encode($data->url); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('is_backend')); ?>:
	<?php echo GxHtml::encode($data->is_backend); ?>
	<br />

</div>