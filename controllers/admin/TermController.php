<?php

class TermController extends AdminController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Term;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Term'])) {
            $model->attributes = $_POST['Term'];
            if ($model->save())
                $this->redirect(array('admin'));
        }
        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('term_', $js, CClientScript::POS_READY);
        $this->render('create', array(
            'model' => $model,
            'listData' => array(0 => '-- Chọn cấp cha --')
        ));
    }

    public function generateJs()
    {
        $nl = "\n";
        $js = '';
        $js .= '$("#Term_vid").change(' . $nl;
        $js .= '    function(){ ' . $nl;
        $js .= '        var sendUrl = "' . $this->createUrl('loadparent') . '&vid="+$(this).val();' . $nl;
        $js .= '        $.ajax({' . $nl;
        $js .= '        url:sendUrl,' . $nl;
        $js .= '        success:function(options){' . $nl;
        $js .= '                    $("#Term_parent").html(options);' . $nl;
        $js .= '                }' . $nl;
        $js .= '        });' . $nl;
        $js .= '    }' . $nl;
        $js .= ');';

        return $js;
    }

    public function actionLoadparent($vid)
{
    $parents = array(0 => '-- Chọn cấp cha --');
    $parents2 = CHtml::listData(Term::model()->findAll("vid=$vid AND parent=0"), 'id', 'name');
    //var_dump(CMap::mergeArray($parents,$parents2));
    $options = array();
    echo CHtml::listOptions('0', CMap::mergeArray($parents, $parents2), $options);
}

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $listData2 = array();
        if ($model->vid)
            $listData2 = CHtml::listData(Term::model()->findAll("vid=$model->vid AND parent=0"), 'id', 'name');
        $listData1 = array(0 => '-- Chọn cấp cha --');
        if (isset($_POST['Term'])) {
            $model->attributes = $_POST['Term'];
            if ($model->save())
                $this->redirect(array('admin'));
        }
        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('term_', $js, CClientScript::POS_READY);
//        var_dump(CMap::mergeArray($listData1,$listData2));die;
        $this->render('update', array(
            'model' => $model,
            'listData' => CMap::mergeArray($listData1, $listData2)
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Term');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Term('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Term']))
            $model->attributes = $_GET['Term'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Term::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'term-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
