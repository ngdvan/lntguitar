
<div id="search_hopam">
    <div id="r_hopam">
        <div id="c_hopam">
            <?php
            /**
             * @var $form GxActiveForm
             * @var $model Hopam
             */
            $form = $this->beginWidget('GxActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'get',
            )); ?>
            <div id="radio_hopam">
                <?php echo CHtml::radioButtonList('key_type', 0, array('Tất cả','Tên bài hát','Ca sĩ/Nhạc sĩ'),array('separator'=>'')); ?>
            </div>
            <div id="sbox_hopam">
                <div id="input_sbox_hopam">
                    <div id="r_input_sbox_hopam">
                    <?php echo CHtml::textField('keyword','',array('id'=>'keyword')); ?>
                    </div>
                </div>

                <?php echo GxHtml::submitButton('',array('id'=>'search_bt')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
