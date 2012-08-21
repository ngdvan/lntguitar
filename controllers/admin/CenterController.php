<?php

class CenterController extends AdminController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Center'),
		));
	}

	public function actionCreate() {
		$model = new Center;


		if (isset($_POST['Center'])) {
			$model->setAttributes($_POST['Center']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('province_', $js, CClientScript::POS_READY);

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Center');

        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('province_', $js, CClientScript::POS_READY);

		if (isset($_POST['Center'])) {
			$model->setAttributes($_POST['Center']);

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
			$this->loadModel($id, 'Center')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Center');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Center('search');
		$model->unsetAttributes();

		if (isset($_GET['Center']))
			$model->setAttributes($_GET['Center']);



		$this->render('admin', array(
			'model' => $model,
		));
	}

    public function generateJs()
    {
        $nl = "\n";
        $js = '';
        $js .= '$("#Center_province_id").change(' . $nl;
        $js .= '    function(){ ' . $nl;
        $js .= '        var sendUrl = "' . $this->createUrl('load') . '&parent="+$(this).val();' . $nl;
        $js .= '        $.ajax({' . $nl;
        $js .= '        url:sendUrl,' . $nl;
        $js .= '        success:function(options){' . $nl;
        $js .= '                    $("#Center_district_id").html(options);' . $nl;
        $js .= '                }' . $nl;
        $js .= '        });' . $nl;
        $js .= '    }' . $nl;
        $js .= ');';

        return $js;
    }

    public function actionLoad()
    {
        $parent = $_GET['parent'];
        $districts = array(0 => '-- Chọn quận huyện --');
        $districts2 = array();
        if($parent)
            $districts2 = CHtml::listData(Term::model()->findAll("parent=$parent"), 'id', 'name');
        //var_dump(CMap::mergeArray($parents,$parents2));
        $options = array();
        echo CHtml::listOptions('0', CMap::mergeArray($districts, $districts2), $options);
    }

}