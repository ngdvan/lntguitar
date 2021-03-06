<?php

/**
 * This is the model base class for the table "{{teacher_photo}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "TeacherPhoto".
 *
 * Columns in table "{{teacher_photo}}" available as properties of the model,
 * followed by relations of table "{{teacher_photo}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $teacher_id
 * @property string $photo
 *
 * @property Teacher $teacher
 */
abstract class BaseTeacherPhoto extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{teacher_photo}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'TeacherPhoto|TeacherPhotos', $n);
	}

	public static function representingColumn() {
		return 'photo';
	}

	public function rules() {
		return array(
			array('teacher_id', 'required'),
			array('teacher_id', 'numerical', 'integerOnly'=>true),
			array('photo', 'length', 'max'=>255),
			array('photo', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, teacher_id, photo', 'safe', 'on'=>'search'),
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
			'teacher_id' => null,
			'photo' => Yii::t('app', 'Photo'),
			'teacher' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('teacher_id', $this->teacher_id);
		$criteria->compare('photo', $this->photo, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}