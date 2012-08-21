<?php

/**
 * This is the model base class for the table "{{register}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Register".
 *
 * Columns in table "{{register}}" available as properties of the model,
 * followed by relations of table "{{register}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $class_id
 * @property string $phone
 * @property string $current_add
 * @property string $note
 * @property integer $create_time
 * @property integer $status
 *
 * @property XfUser $user
 */
abstract class BaseRegister extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{register}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Register|Registers', $n);
	}

	public static function representingColumn() {
		return 'phone';
	}

	public function rules() {
		return array(
			array('user_id, class_id, phone, current_add', 'required'),
			array('user_id, class_id, create_time, status', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>20),
			array('current_add', 'length', 'max'=>255),
			array('note', 'safe'),
			array('note, create_time, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, class_id, phone, current_add, note, create_time, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'XfUser', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => null,
			'class_id' => Yii::t('app', 'Class'),
			'phone' => Yii::t('app', 'Phone'),
			'current_add' => Yii::t('app', 'Current Add'),
			'note' => Yii::t('app', 'Note'),
			'create_time' => Yii::t('app', 'Create Time'),
			'status' => Yii::t('app', 'Status'),
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('class_id', $this->class_id);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('current_add', $this->current_add, true);
		$criteria->compare('note', $this->note, true);
		$criteria->compare('create_time', $this->create_time);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}
