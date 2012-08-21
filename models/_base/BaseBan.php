<?php

/**
 * This is the model base class for the table "{{ban}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Ban".
 *
 * Columns in table "{{ban}}" available as properties of the model,
 * followed by relations of table "{{ban}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 *
 * @property Song[] $songs
 */
abstract class BaseBan extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{ban}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Ban nhạc/Ca sĩ', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>255),
			array('body', 'safe'),
			array('body', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, body', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'songs' => array(self::HAS_MANY, 'Song', 'ban_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Tên ban nhạc/Ca sĩ'),
			'body' => Yii::t('app', 'Miêu tả'),
			'songs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('body', $this->body, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}