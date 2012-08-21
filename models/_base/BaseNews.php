<?php

/**
 * This is the model base class for the table "{{news}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "News".
 *
 * Columns in table "{{news}}" available as properties of the model,
 * followed by relations of table "{{news}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $user_id
 * @property integer $term_id
 * @property integer $view
 * @property integer $status
 *
 * @property XfUser $user
 * @property Term $term
 */
abstract class BaseNews extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{news}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'News|News', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, body', 'required'),
			array('create_time, update_time, user_id, term_id, status,view', 'numerical', 'integerOnly'=>true),
			array('title,image', 'length', 'max'=>255),
			array('create_time, update_time, user_id, term_id, status,view', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, body, create_time, update_time, user_id, term_id, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'XfUser', 'user_id'),
			'term' => array(self::BELONGS_TO, 'Term', 'term_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Tiêu đề'),
			'body' => Yii::t('app', 'Nội dung'),
			'create_time' => Yii::t('app', 'Ngày đăng'),
			'update_time' => Yii::t('app', 'Ngày sửa'),
			'user_id' => null,
			'term_id' => null,
			'status' => Yii::t('app', 'Trạng thái'),
			'user' => null,
			'term' => null,
            'image'=>'Ảnh',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('create_time', $this->create_time);
		$criteria->compare('update_time', $this->update_time);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('term_id', $this->term_id);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}