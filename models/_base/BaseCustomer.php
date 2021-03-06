<?php

/**
 * This is the model base class for the table "{{customer}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Customer".
 *
 * Columns in table "{{customer}}" available as properties of the model,
 * followed by relations of table "{{customer}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property string $address
 * @property string $user_id
 *
 * @property XfUser $user
 */
abstract class BaseCustomer extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{customer}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Khách hàng', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, tel, email, address', 'required'),
			array('name, tel, email, address', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>10),
			array('name, tel, email, address, user_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, tel, email, address, user_id', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app', 'Họ tên'),
			'tel' => Yii::t('app', 'Điện thoại'),
			'email' => Yii::t('app', 'Email'),
			'address' => Yii::t('app', 'Địa chỉ'),
			'user_id' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('tel', $this->tel, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('user_id', $this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}