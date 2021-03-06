<?php

class NewsController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'News'),
		));
	}

	public function actionCreate() {
		$model = new News;


		if (isset($_POST['News'])) {
			$model->setAttributes($_POST['News']);
            $model->image = CUploadedFile::getInstance($model, 'image');

            if ((is_object($model->image) && get_class($model->image) === 'CUploadedFile')) {

                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/images/";
                $ext = strtolower($model->image->getExtensionName());
                $fileName = "img_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/images";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $model->image->saveAs($des);
                $model->image = "/upload/images/" . $uri;
            }
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
		$model = $this->loadModel($id, 'News');

        $img_path = $model->image;
		if (isset($_POST['News'])) {
			$model->setAttributes($_POST['News']);
            $img = CUploadedFile::getInstance($model, 'image');
            //var_dump($img);die;
            if ($img && (is_object($img) && get_class($img) === 'CUploadedFile')) {
                $model->image = $img;
                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/images/";
                $ext = strtolower($model->image->getExtensionName());
                $fileName = "img_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/images";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $model->image->saveAs($des);
                $model->image = "/upload/images/" . $uri;
            } else {
                $model->setAttribute('image', $img_path);
            }
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
			$this->loadModel($id, 'News')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('News');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new News('search');
		$model->unsetAttributes();

		if (isset($_GET['News']))
			$model->setAttributes($_GET['News']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}