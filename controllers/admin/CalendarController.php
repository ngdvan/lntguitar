<?php

class CalendarController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ClassCalendar'),
		));
	}

	public function actionCreate() {
		$model = new ClassCalendar;

		if (isset($_POST['ClassCalendar'])) {
            $_POST['ClassCalendar']['start_time'] = strtotime($_POST['ClassCalendar']['start_time']);
            $_POST['ClassCalendar']['end_time'] = strtotime($_POST['ClassCalendar']['end_time']);
			$model->setAttributes($_POST['ClassCalendar']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin'));
			}
		}
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui-timepicker.js', CClientScript::POS_HEAD);
        $cssCoreUrl = Yii::app()->clientScript->getCoreScriptUrl();

// now that we know the core folder, register
        Yii::app()->clientScript->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
        $this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'ClassCalendar');


		if (isset($_POST['ClassCalendar'])) {
            $_POST['ClassCalendar']['start_time'] = strtotime($_POST['ClassCalendar']['start_time']);
            $_POST['ClassCalendar']['end_time'] = strtotime($_POST['ClassCalendar']['end_time']);
			$model->setAttributes($_POST['ClassCalendar']);

			if ($model->save()) {
				$this->redirect(array('admin'));
			}
		}
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui-timepicker.js', CClientScript::POS_HEAD);
        $cssCoreUrl = Yii::app()->clientScript->getCoreScriptUrl();

// now that we know the core folder, register
        Yii::app()->clientScript->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'ClassCalendar')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ClassCalendar');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ClassCalendar('search');
		$model->unsetAttributes();

		if (isset($_GET['ClassCalendar']))
			$model->setAttributes($_GET['ClassCalendar']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}