<?php

class VideoController extends AdminController
{


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Video'),
        ));
    }

    public function actionCreate()
    {
        $model = new Video;


        if (isset($_POST['Video'])) {
            $model->setAttributes($_POST['Video']);
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
            /*
                        $model->file_path = CUploadedFile::getInstance($model, 'video_file');

                        if ((is_object($model->file_path) && get_class($model->file_path) === 'CUploadedFile')) {

                            $dirVideo = Yii::getPathOfAlias('webroot') . "/upload/video/";
                            $ext = strtolower($model->file_path->getExtensionName());
                            $fileName = "video_" . date("YmHis", time()) . "." . $ext;
                            $des = $dirVideo . date("Y/m/d", time()) . '/' . $fileName;

                            if (!is_dir($des)) {
                                $list_dir = explode("/", date("Y/m/d", time()));
                                $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/video";
                                foreach ($list_dir as $dr) {
                                    $temp_dir .= "/" . $dr;
                                    if (!is_dir($temp_dir)) {
                                        mkdir($temp_dir);
                                        chmod($temp_dir, 0755);
                                    }
                                }
                            }
                            $model->file_path->saveAs($des);
                            $model->file_path = "/upload/video/" . date("Y/m/d", time()) . '/' . $fileName;
                        }
            */
//            var_dump($model);die;
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
        $model = $this->loadModel($id, 'Video');
        //$video_path = $model->file_path;
        $img_path = $model->image;
        //var_dump($model->user_id);
        if (isset($_POST['Video'])) {
            $model->setAttributes($_POST['Video']);

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
            /*
            $video = CUploadedFile::getInstance($model, 'file_path');

            if ((is_object($model->file_path) && get_class($model->file_path) === 'CUploadedFile')) {
                $model->file_path = $video;
                $dirVideo = Yii::getPathOfAlias('webroot') . "/upload/video/";
                $ext = strtolower($model->file_path->getExtensionName());
                $fileName = "video_" . date("YmHis", time()) . "." . $ext;
                $des = $dirVideo . date("Y/m/d", time()) . '/' . $fileName;

                if (!is_dir($des)) {
                    $list_dir = explode("/", date("Y/m/d", time()));
                    $temp_dir = Yii::getPathOfAlias('webroot') . "/upload/video";
                    foreach ($list_dir as $dr) {
                        $temp_dir .= "/" . $dr;
                        if (!is_dir($temp_dir)) {
                            mkdir($temp_dir);
                            chmod($temp_dir, 0755);
                        }
                    }
                }
                $model->file_path->saveAs($des);
                $model->file_path = "/upload/video/" . date("Y/m/d", time()) . '/' . $fileName;
            }else{
                $model->file_path = $video_path;
            }
            */
//            var_dump($model);die;
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    /**
     * Suggests tags based on the current user input.
     * This is called via AJAX when the user is entering the tags input.
     */
    public function actionSuggestTags()
    {
        if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
        {
            $tags=VideoTag::model()->suggestTags($keyword);
            if($tags!==array())
                echo implode("\n",$tags);
        }
    }
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Video')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Video');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model = new Video('search');
        $model->unsetAttributes();

        if (isset($_GET['Video']))
            $model->setAttributes($_GET['Video']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }
 public function actionDelImage($id){
        $video = Video::model()->findByPk($id);
        if($video){
            
            unlink(Yii::getPathOfAlias('webroot').$video->image);
            $video->image = 'NULL';
            $video->save();
        }
    }


}