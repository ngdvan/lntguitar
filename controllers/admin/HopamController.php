<?php

class HopamController extends AdminController
{


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Hopam'),
        ));
    }

    public function actionCreate()
    {
        $model = new Hopam;


        if (isset($_POST['Hopam'])) {
            $model->setAttributes($_POST['Hopam']);

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

            $lyrics = CUploadedFile::getInstance($model, 'lyrics');

            if ((is_object($lyrics) && get_class($lyrics) === 'CUploadedFile')) {

                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/lyrics/";
                $ext = strtolower($lyrics->getExtensionName());
                $fileName = "lyrics_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/lyrics";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $lyrics->saveAs($des);
                $model->lyrics = "/upload/lyrics/" . $uri;
            }

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Hopam');

        $img_path = $model->image;
        $lyrics_file = $model->lyrics;
        if (isset($_POST['Hopam'])) {
            $model->setAttributes($_POST['Hopam']);

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

            $lyrics = CUploadedFile::getInstance($model, 'lyrics');

            if ((is_object($lyrics) && get_class($lyrics) === 'CUploadedFile')) {

                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/lyrics/";
                $ext = strtolower($lyrics->getExtensionName());
                $fileName = "lyrics_" . date("YmHis", time()) . "." . $ext;
                $uri = date("Y/m/d", time()) . '/' . $fileName;
                $des = $dirImages . $uri;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/lyrics";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }

                $lyrics->saveAs($des);
                $model->lyrics = "/upload/lyrics/" . $uri;

            } else {
                $model->setAttribute('lyrics', $lyrics_file);
            }


            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Hopam')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Hopam');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model = new Hopam('search');
        $model->unsetAttributes();

        if (isset($_GET['Hopam']))
            $model->setAttributes($_GET['Hopam']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Suggests tags based on the current user input.
     * This is called via AJAX when the user is entering the tags input.
     */
    public function actionSuggestTags()
    {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = HopamTag::model()->suggestTags($keyword);
            if ($tags !== array())
                echo implode("\n", $tags);
        }
    }

    public function actionBans()
    {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Ban::model()->suggestTags($keyword);
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