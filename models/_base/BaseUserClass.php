<?php

/**
 * This is the model base class for the table "{{user_class}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserClass".
 *
 * Columns in table "{{user_class}}" available as properties of the model,
 * followed by relations of table "{{user_class}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $class_id
 *
 * @property ClassGuitar $class
 * @property XfUser $user
 */
abstract class BaseUserClass extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{user_class}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Học viên', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('user_id, class_id', 'required'),
			array('user_id, class_id', 'numerical', 'integerOnly'=>true),
			array('id, user_id, class_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'class' => array(self::BELONGS_TO, 'ClassGuitar', 'class_id'),
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
			'class_id' => null,
			'class' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('class_id', $this->class_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}