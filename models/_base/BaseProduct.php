<?php

/**
 * This is the model base class for the table "{{product}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Product".
 *
 * Columns in table "{{product}}" available as properties of the model,
 * followed by relations of table "{{product}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $code
 * @property string $mpn_code
 * @property integer $price
 * @property string $video
 * @property string $teach_info
 * @property string $body
 * @property integer $cat_id
 * @property integer $th_id
 * @property integer $count_buy
 * @property integer $status
 *
 * @property Term $cat
 * @property Term $th
 * @property ProductImage[] $productImages
 */
abstract class BaseProduct extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{product}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Sản phẩm', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, price, cat_id, th_id', 'required'),
			array('price, cat_id, th_id, count_buy, status', 'numerical', 'integerOnly'=>true),
			array('title, image, video', 'length', 'max'=>255),
			array('code, mpn_code', 'length', 'max'=>100),
			array('teach_info, body', 'safe'),
			array('image, code, mpn_code, video, teach_info, body, count_buy, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, image, code, mpn_code, price, video, teach_info, body, cat_id, th_id, count_buy, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cat' => array(self::BELONGS_TO, 'Term', 'cat_id'),
			'th' => array(self::BELONGS_TO, 'Term', 'th_id'),
			'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Tên'),
			'image' => Yii::t('app', 'Ảnh'),
			'code' => Yii::t('app', 'Code'),
			'mpn_code' => Yii::t('app', 'Mpn Code'),
			'price' => Yii::t('app', 'Giá'),
			'video' => Yii::t('app', 'Link Youtube'),
			'teach_info' => Yii::t('app', 'Thông số kỹ thuật'),
			'body' => Yii::t('app', 'Chi tiết sản phẩm'),
			'cat_id' => null,
			'th_id' => null,
			'count_buy' => Yii::t('app', 'Count Buy'),
			'status' => Yii::t('app', 'Trạng thái'),
			'cat' => null,
			'th' => null,
			'productImages' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('mpn_code', $this->mpn_code, true);
		$criteria->compare('price', $this->price);
		$criteria->compare('video', $this->video, true);
		$criteria->compare('teach_info', $this->teach_info, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('cat_id', $this->cat_id);
		$criteria->compare('th_id', $this->th_id);
		$criteria->compare('count_buy', $this->count_buy);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['itemsPerPage'],
            ),
		));
	}
}