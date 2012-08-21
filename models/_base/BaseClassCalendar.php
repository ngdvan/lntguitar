<?php

/**
 * This is the model base class for the table "{{class_calendar}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ClassCalendar".
 *
 * Columns in table "{{class_calendar}}" available as properties of the model,
 * followed by relations of table "{{class_calendar}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $day
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $class_id
 *
 * @property ClassGuitar $class
 */
abstract class BaseClassCalendar extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{class_calendar}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Thời khóa biểu', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('day, start_time, end_time, class_id', 'required'),
			array('day, class_id', 'numerical', 'integerOnly'=>true),
			array('id, day, start_time, end_time, class_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'class' => array(self::BELONGS_TO, 'ClassGuitar', 'class_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'day' => Yii::t('app', 'Thứ'),
			'start_time' => Yii::t('app', 'Bắt đầu'),
			'end_time' => Yii::t('app', 'Kết thúc'),
			'class_id' => null,
			'class' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('day', $this->day);
		$criteria->compare('start_time', $this->start_time);
		$criteria->compare('end_time', $this->end_time);
		$criteria->compare('class_id', $this->class_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}