<?php

/**
 * This is the model base class for the table "{{rate_hopam}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "RateHopam".
 *
 * Columns in table "{{rate_hopam}}" available as properties of the model,
 * followed by relations of table "{{rate_hopam}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $hopam_id
 * @property integer $marks
 *
 * @property Hopam $hopam
 */
abstract class BaseRateHopam extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{rate_hopam}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'RateHopam|RateHopams', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('user_id, hopam_id', 'required'),
			array('user_id, hopam_id, marks', 'numerical', 'integerOnly'=>true),
			array('marks', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, hopam_id, marks', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'hopam' => array(self::BELONGS_TO, 'Hopam', 'hopam_id'),
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
			'hopam_id' => null,
			'marks' => Yii::t('app', 'Marks'),
			'hopam' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('hopam_id', $this->hopam_id);
		$criteria->compare('marks', $this->marks);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}