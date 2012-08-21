<?php

class SongController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Song'),
		));
	}

	public function actionCreate() {
		$model = new Song;


		if (isset($_POST['Song'])) {
			$model->setAttributes($_POST['Song']);
			/*$model->image = CUploadedFile::getInstance($model, 'image');
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
            }*/

            $model->lyrics = CUploadedFile::getInstance($model, 'lyrics');
            if ((is_object($model->lyrics) && get_class($model->lyrics) === 'CUploadedFile')) {

                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/songs/";
                $ext = strtolower($model->lyrics->getExtensionName());
                $fileName = "song_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/songs";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $model->lyrics->saveAs($des);
                $model->lyrics = "/upload/songs/" . $uri;
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
		$model = $this->loadModel($id, 'Song');

		/*$img_path = $model->image;
		
		if (isset($_POST['Song'])) {
			$model->setAttributes($_POST['Song']);

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
				$this->redirect(array('view', 'id' => $model->id));
			}
		}*/

        $img_path = $model->lyrics;

        if (isset($_POST['Song'])) {
            $model->setAttributes($_POST['Song']);

            $img = CUploadedFile::getInstance($model, 'lyrics');
            //var_dump($img);die;
            if ($img && (is_object($img) && get_class($img) === 'CUploadedFile')) {
                $model->lyrics = $img;
                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/songs/";
                $ext = strtolower($model->lyrics->getExtensionName());
                $fileName = "song_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/songs";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $model->lyrics->saveAs($des);
                $model->lyrics = "/upload/songs/" . $uri;
            } else {
                $model->setAttribute('lyrics', $img_path);
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
			$this->loadModel($id, 'Song')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Song');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Song('search');
		$model->unsetAttributes();

		if (isset($_GET['Song']))
			$model->setAttributes($_GET['Song']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
    public function actionBans()
    {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = SongBans::model()->suggestTags($keyword);
            //var_dump($tags);die;
            if ($tags !== array())
                echo implode("\n", $tags);
        }
    }


    function actionDownload($path)
    {
        if(!class_exists("LntDownload"))
            Yii::import('app.components.LntDownload');
        LntDownload::download($path);
    }
}