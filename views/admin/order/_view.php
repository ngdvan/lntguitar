<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
	<?php echo GxHtml::encode($data->user_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cost')); ?>:
	<?php echo GxHtml::encode($data->cost); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paid')); ?>:
	<?php echo GxHtml::encode($data->paid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo GxHtml::encode($data->create_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paid_time')); ?>:
	<?php echo GxHtml::encode($data->paid_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('pid')); ?>:
	<?php echo GxHtml::encode($data->pid); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>