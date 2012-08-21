<?php

class TeacherController extends AdminController
{


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Teacher'),
        ));
    }

    public function actionCreate()
    {
        $model = new Teacher;

        if (isset($_POST['Teacher'])) {
            $model->setAttributes($_POST['Teacher']);

            $model->picture = CUploadedFile::getInstance($model, 'picture');

            if ((is_object($model->picture) && get_class($model->picture) === 'CUploadedFile')) {

                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/images/";
                $ext = strtolower($model->picture->getExtensionName());
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

                $model->picture->saveAs($des);
                $model->picture = "/upload/images/" . $uri;
            }

            if ($model->save()) {
                //slide ảnh
                $photos = CUploadedFile::getInstancesByName('photos');
                //var_dump($photos);die();
                // proceed if the images have been set
                if (isset($photos) && count($photos) > 0) {
                    $dirPhotos = Yii::getPathOfAlias('webroot') . "/upload/images/";

                    // go through each uploaded image
                    foreach ($photos as $image => $pic) {
                        //echo $pic->name . '<br />';
                        $ext = strtolower($pic->getExtensionName());
                        $fileName = "img_" . date("YmHis", time()) . "." . $ext;
                        $uri = date("Y/m/d", time()) . '/' . $fileName;
                        $desPhotos = $dirPhotos . $uri;
                        if (!is_dir($desPhotos)) {
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
                        if ($pic->saveAs($desPhotos)) {
                            $tPhoto = new TeacherPhoto();
                            $tPhoto->teacher_id = $model->id;
                            $tPhoto->photo = '/upload/images/'.$uri;
                            $tPhoto->save(); // DONE
                        }

                    }
                }
                //----------------
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
        $model = $this->loadModel($id, 'Teacher');
        $img_path = $model->picture;
        if (isset($_POST['Teacher'])) {
            $model->setAttributes($_POST['Teacher']);
            $img = CUploadedFile::getInstance($model, 'picture');
            //var_dump($img);die;
            if ($img && (is_object($img) && get_class($img) === 'CUploadedFile')) {
                $model->picture = $img;
                $dirImages = Yii::getPathOfAlias('webroot') . "/upload/images/";
                $ext = strtolower($model->picture->getExtensionName());
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

                $model->picture->saveAs($des);
                $model->picture = "/upload/images/" . $uri;
            }else{
                $model->setAttribute('picture',$img_path);
            }

            if ($model->save()) {
                $photos = CUploadedFile::getInstancesByName('photos');
                //var_dump($photos);die();
                // proceed if the images have been set
                if (isset($photos) && count($photos) > 0) {
                    $dirPhotos = Yii::getPathOfAlias('webroot') . "/upload/images/";

                    // go through each uploaded image
                    foreach ($photos as $image => $pic) {
                        //echo $pic->name . '<br />';
                        $ext = strtolower($pic->getExtensionName());
                        $fileName = "img_" . date("YmHis", time()) . "." . $ext;
                        $uri = date("Y/m/d", time()) . '/' . $fileName;
                        $desPhotos = $dirPhotos . $uri;
                        if (!is_dir($desPhotos)) {
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
                        if ($pic->saveAs($desPhotos)) {
                            $tPhoto = new TeacherPhoto();
                            $tPhoto->teacher_id = $model->id;
                            $tPhoto->photo = '/upload/images/'.$uri;
                            $tPhoto->save(); // DONE
                        }

                    }
                }
                //----------------

                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    public function actionDelphoto($id){
        $photo = TeacherPhoto::model()->findByPk($id);
        if($photo){
            $photo->delete();
        }
    }
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Teacher')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Teacher');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model = new Teacher('search');
        $model->unsetAttributes();

        if (isset($_GET['Teacher']))
            $model->setAttributes($_GET['Teacher']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}