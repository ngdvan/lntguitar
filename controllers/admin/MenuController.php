<?php

class MenuController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'MenuItems'),
		));
	}

	public function actionCreate() {
		$model = new MenuItems;


		if (isset($_POST['MenuItems'])) {
			$model->setAttributes($_POST['MenuItems']);

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
		$model = $this->loadModel($id, 'MenuItems');


		if (isset($_POST['MenuItems'])) {
			$model->setAttributes($_POST['MenuItems']);

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
			$this->loadModel($id, 'MenuItems')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('MenuItems');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new MenuItems('search');
		$model->unsetAttributes();

		if (isset($_GET['MenuItems']))
			$model->setAttributes($_GET['MenuItems']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}