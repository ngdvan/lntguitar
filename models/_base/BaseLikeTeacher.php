<?php

/**
 * This is the model base class for the table "{{like_teacher}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "LikeTeacher".
 *
 * Columns in table "{{like_teacher}}" available as properties of the model,
 * followed by relations of table "{{like_teacher}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $teacher_id
 * @property integer $like_time
 *
 * @property Teacher $teacher
 */
abstract class BaseLikeTeacher extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{like_teacher}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'LikeTeacher|LikeTeachers', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('user_id, teacher_id', 'required'),
			array('user_id, teacher_id, like_time', 'numerical', 'integerOnly'=>true),
			array('like_time', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, teacher_id, like_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => Yii::t('app', 'User'),
			'teacher_id' => null,
			'like_time' => Yii::t('app', 'Like Time'),
			'teacher' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('teacher_id', $this->teacher_id);
		$criteria->compare('like_time', $this->like_time);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}