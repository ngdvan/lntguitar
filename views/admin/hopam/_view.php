<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('lyrics')); ?>:
	<?php echo GxHtml::encode($data->lyrics); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embed_code')); ?>:
	<?php echo GxHtml::encode($data->embed_code); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tid')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->t)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('view')); ?>:
	<?php echo GxHtml::encode($data->view); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ban_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->ban)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('guider')); ?>:
	<?php echo GxHtml::encode($data->guider); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo GxHtml::encode($data->create_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tags')); ?>:
	<?php echo GxHtml::encode($data->tags); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo GxHtml::encode($data->update_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>