<?php

class ClassGuitarController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ClassGuitar'),
		));
	}

	public function actionCreate() {
		$model = new ClassGuitar;


		if (isset($_POST['ClassGuitar'])) {
            if ($_POST['ClassGuitar']['start_time'] && !is_numeric($_POST['ClassGuitar']['start_time'])) {
                $arrDate = explode('/', $_POST['ClassGuitar']['start_time']);
                $_POST['ClassGuitar']['start_time'] = mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]);
            }
            if ($_POST['ClassGuitar']['end_time'] && !is_numeric($_POST['ClassGuitar']['end_time'])) {
                $arrDate = explode('/', $_POST['ClassGuitar']['end_time']);
                $_POST['ClassGuitar']['end_time'] = mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]);
            }

			$model->setAttributes($_POST['ClassGuitar']);

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
		$model = $this->loadModel($id, 'ClassGuitar');


		if (isset($_POST['ClassGuitar'])) {
            if ($_POST['ClassGuitar']['start_time'] && !is_numeric($_POST['ClassGuitar']['start_time'])) {
                $arrDate = explode('/', $_POST['ClassGuitar']['start_time']);
                $_POST['ClassGuitar']['start_time'] = mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]);
            }
            if ($_POST['ClassGuitar']['end_time'] && !is_numeric($_POST['ClassGuitar']['end_time'])) {
                $arrDate = explode('/', $_POST['ClassGuitar']['end_time']);
                $_POST['ClassGuitar']['end_time'] = mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]);
            }
			$model->setAttributes($_POST['ClassGuitar']);

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
			$this->loadModel($id, 'ClassGuitar')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ClassGuitar');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ClassGuitar('search');
		$model->unsetAttributes();

		if (isset($_GET['ClassGuitar']))
			$model->setAttributes($_GET['ClassGuitar']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}