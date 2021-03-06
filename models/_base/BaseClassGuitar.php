<?php

/**
 * This is the model base class for the table "{{class_guitar}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ClassGuitar".
 *
 * Columns in table "{{class_guitar}}" available as properties of the model,
 * followed by relations of table "{{class_guitar}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $sku
 * @property integer $status
 * @property integer $tid
 * @property integer $cid
 * @property integer $start_time
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $max
 *
 * @property Student[] $students
 * @property integer $studentCount
 * @property Center $c
 * @property Training $t
 */
abstract class BaseClassGuitar extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{class_guitar}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Lớp học', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, tid, cid,sku,teacher_id', 'required'),
			array('status, tid, cid, create_time, update_time,max,teacher_id', 'numerical', 'integerOnly'=>true),
			array('title,sku', 'length', 'max'=>255),
			array('body,sku', 'safe'),
			array('body, status, tid, cid, start_time, create_time,end_time, update_time', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, body,sku,end_time, status, tid, cid, start_time, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'classCalendars' => array(self::HAS_MANY, 'ClassCalendar', 'class_id'),
			'c' => array(self::BELONGS_TO, 'Center', 'cid'),
			't' => array(self::BELONGS_TO, 'Training', 'tid'),
			'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
			'students' => array(self::HAS_MANY, 'Student', 'class_id'),
			'studentCount' => array(self::STAT, 'Student', 'class_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Tên lớp'),
			'body' => Yii::t('app', 'Miêu tả'),
			'status' => Yii::t('app', 'Trạng thái'),
			'tid' => null,
			'cid' => null,
			'start_time' => Yii::t('app', 'Bắt đầu'),
			'end_time' => Yii::t('app', 'Kết thúc'),
			'create_time' => Yii::t('app', 'Create Time'),
			'update_time' => Yii::t('app', 'Update Time'),
			'classCalendars' => null,
			'c' => null,
			't' => null,
			'max' => 'Cần tuyển',
			'sku' => 'Mã lớp',
			'teacher' => 'Giảng viên',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('tid', $this->tid);
		$criteria->compare('cid', $this->cid);
		$criteria->compare('start_time', $this->start_time);
		$criteria->compare('create_time', $this->create_time);
		$criteria->compare('update_time', $this->update_time);
        //$criteria->compare('teacher_id', $this->teacher_id);
        $criteria->compare('max', $this->max);
        //$criteria->compare('end_time', $this->end_time);
        $criteria->compare('sku', $this->sku, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}