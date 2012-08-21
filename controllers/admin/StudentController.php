<?php

class StudentController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Student'),
		));
	}

	public function actionCreate() {
		$model = new Student;


		if (isset($_POST['Student'])) {
			$model->setAttributes($_POST['Student']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Student');


		if (isset($_POST['Student'])) {
			$model->setAttributes($_POST['Student']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Student')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Student');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Student('search');
		$model->unsetAttributes();

		if (isset($_GET['Student']))
			$model->setAttributes($_GET['Student']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}