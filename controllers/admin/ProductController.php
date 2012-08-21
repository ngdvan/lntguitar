<?php

class ProductController extends AdminController
{


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Product'),
        ));
    }

    public function actionCreate()
    {
        $model = new Product;


        if (isset($_POST['Product'])) {
            $model->setAttributes($_POST['Product']);

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
                            $tPhoto = new ProductImage();
                            $tPhoto->product_id = $model->id;
                            $tPhoto->file_path = '/upload/images/' . $uri;
                            $tPhoto->save(); // DONE
                        }

                    }
                }


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
        /**
         * @var $model Product
         */
        $model = $this->loadModel($id, 'Product');
        $img_path = $model->image;

        if (isset($_POST['Product'])) {
            $model->setAttributes($_POST['Product']);

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
            }else{
                $model->setAttribute('image',$img_path);
            }

            if ($model->save()) {

                $photos = CUploadedFile::getInstancesByName('photos');
                //var_dump($photos);die();
                // proceed if the images have been set
                if (isset($photos) && count($photos) > 0) {
                    $dirPhotos = Yii::getPathOfAlias('webroot') . "/upload/images/";

                    // go through each uploaded image
                    //var_dump($photos);die;
                    foreach ($photos as $pic) {
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
                            $tPhoto = new ProductImage();
                            $tPhoto->product_id = $model->id;
                            $tPhoto->file_path = '/upload/images/'.$uri;
                            $tPhoto->save(); // DONE
                        }

                    }
                }

                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    public function actionDelphoto($id){
        $photo = ProductImage::model()->findByPk($id);
        if($photo){
            $photo->delete();
        }
    }
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Product')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Product');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model = new Product('search');
        $model->unsetAttributes();

        if (isset($_GET['Product']))
            $model->setAttributes($_GET['Product']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}