<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tel')); ?>:
	<?php echo GxHtml::encode($data->tel); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('birthday')); ?>:
	<?php echo GxHtml::encode($data->birthday); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('class_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->class)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
	<?php echo GxHtml::encode($data->user_id); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('comment')); ?>:
	<?php echo GxHtml::encode($data->comment); ?>
	<br />
	*/ ?>

</div>