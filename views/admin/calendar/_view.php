<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('day')); ?>:
	<?php echo GxHtml::encode($data->day); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('time')); ?>:
	<?php echo GxHtml::encode($data->time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('class_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->class)); ?>
	<br />

</div>