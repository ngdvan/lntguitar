<?php

class PageController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Page'),
		));
	}

	public function actionCreate() {
		$model = new Page;
		if (isset($_POST['Page'])) {
			$model->setAttributes($_POST['Page']);

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
		$model = $this->loadModel($id, 'Page');


		if (isset($_POST['Page'])) {
			$model->setAttributes($_POST['Page']);

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
			$this->loadModel($id, 'Page')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Page');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Page('search');
		$model->unsetAttributes();

		if (isset($_GET['Page']))
			$model->setAttributes($_GET['Page']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}