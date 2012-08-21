<?php

class BanController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Ban'),
		));
	}

	public function actionCreate() {
		$model = new Ban;


		if (isset($_POST['Ban'])) {
			$model->setAttributes($_POST['Ban']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin'));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Ban');


		if (isset($_POST['Ban'])) {
			$model->setAttributes($_POST['Ban']);

			if ($model->save()) {
                $this->redirect(array('admin'));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Ban')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Ban');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Ban('search');
		$model->unsetAttributes();

		if (isset($_GET['Ban']))
			$model->setAttributes($_GET['Ban']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}