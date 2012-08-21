<?php
/**
 * User: thanhdx
 * Date: 6/13/12
 * Time: 10:46 PM
 * @file TraningController.php
 */
class TrainingController extends Controller
{
    public $layout = 'column1';

    public function accessRules()
    {
        return array(
            array('deny',
                'actions' => array('register'),
                'users' => array('?'),
            ),
            array('allow',
                'actions' => array('login', 'index', 'view', 'list'),
                'users' => array('?'),
            ),
        );
    }

    public function actionIndex()
    {
        $center = new Center('search');

        $this->render('index', array('center' => $center));
    }

    public function actionList()
    {
        $criteria = new CDbCriteria();
        $title = "Danh sách lớp học";
        if (isset($_GET['tid'])) {
            $criteria->addCondition('tid=' . $_GET['tid']);
            $training = Training::model()->findByPk($_GET['tid']);
            $title = 'Các lớp học thuộc khóa ' . $training->title;
        }

        $dataProvider = new CActiveDataProvider("ClassGuitar", array(
            'criteria' => $criteria,
        ));
        $this->render('list', array('items' => $dataProvider, 'title' => $title));
    }

    public function actionCenter()
    {
//        $center = Center::model()->findByPk($_GET['id']);
        $criteria = new CDbCriteria();
        $criteria->addCondition('cid=' . $_GET['id']);
        $criteria->addCondition('end_time >' . time());
        $dataProvider = new CActiveDataProvider("ClassGuitar", array(
            'criteria' => $criteria,
        ));

        $criteria2 = new CDbCriteria();
        $criteria2->addCondition('cid=' . $_GET['id']);
        $criteria2->addCondition('end_time <' . time());
        $dataProvider2 = new CActiveDataProvider("ClassGuitar", array(
            'criteria' => $criteria2,
        ));

        $center = Center::model()->findByPk($_GET['id']);
        $this->render('center', array('dataProvider' => $dataProvider, 'dataProvider2' => $dataProvider2, 'center' => $center));

    }

    public function actionClass()
    {
        $db = Yii::app()->db;

        $class_id = $_GET['id'];
        $classGuitar = ClassGuitar::model()->findByPk($class_id);

        $criteria = new CDbCriteria();
        $criteria->addCondition('class_id=' . $class_id);
        $dataProvider = new CActiveDataProvider("Student", array(
            'criteria' => $criteria,
        ));

        $sql = "SELECT `day`,start_time FROM {{class_calendar}} WHERE class_id = $class_id";
        $cmd = $db->createCommand($sql);
        $calendar = $cmd->queryRow();

        /*$sql = "SELECT class_id FROM {{class_calendar}} WHERE day=".$calendar['day']." AND start_time = ".$calendar['start_time']." AND class_id <> ".$classGuitar->id;
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        $ids = array();
        foreach($dataReader as $item){
            $ids[] = $item['class_id'];
        }*/


        $data = array('classGuitar' => $classGuitar, 'students' => $dataProvider);

        $criteria2 = new CDbCriteria();
        //$criteria2->addCondition('id IN ('.implode(',',$ids).")");
        $criteria2->addCondition('cid =' . $classGuitar->cid);
        $criteria2->addCondition('id <>' . $classGuitar->id);
        $criteria2->addCondition('end_time < ' . time());
        $dataProvider2 = new CActiveDataProvider("ClassGuitar", array(
            'criteria' => $criteria2,
        ));
        $data['relatedClass'] = $dataProvider2;


        $this->render('class', $data);
    }

    public function actionRegister()
    {
        $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
        $arrayKeys = array_keys($arrayAuthRoleItems);
        $role = strtolower ($arrayKeys[0]);
        if($role == 'admin' || $role == 'teacher')
            $this->redirect('/');
        $this->layout = 'dangkyhoc';

        $model = new Student;
        if (isset($_GET['cid']) && (int)$_GET['cid'])
            $model->class_id = $_GET['cid'];


        $db = Yii::app()->db;

        if (isset($_POST['Student']) && $_POST['Student']) {
            $model->setAttributes($_POST['Student']);

            $gclass = ClassGuitar::model()->findByPk($model->class_id);

            $sql = "SELECT * FROM {{student}} WHERE user_id =" . Yii::app()->user->id . " ORDER BY id DESC";
            $cmd = $db->createCommand($sql);
            $student = $cmd->queryRow();

            if ($student) {
//                var_dump($studentơclass_id);
                $gclass2 = ClassGuitar::model()->findByPk($student['class_id']);
                if ($student['status'] == 'comp') { //Hoàn thành

                    if ($gclass->tid <= $gclass2->tid) {
                        $training = Training::model()->findByPk($gclass2->tid);
                        Yii::app()->user->setFlash('error', 'Bạn đã hoàn thành một lớp thuộc khóa <b>' . $training->title . '</b>. Vui lòng đăng ký khóa học cao hơn.');
                    }

                } elseif ($student['status'] == 'reg') { // Mới đăng ký
                    Yii::app()->user->setFlash('error', 'Bạn đã đăng ký học tại lớp <b>' . $gclass2->title . '</b>. Vui lòng hủy đơn đăng ký này trước khi đăng ký tham gia lớp học khác!');
                } else {
                    $center = Center::model()->findByPk($gclass2->cid);
                    Yii::app()->user->setFlash('error', 'Bạn đang tham gia lớp học <b>' . $gclass2->title . '</b> tại cơ sở <b>' . $center->title . '</b>!');
                }
            } else {

            }
            if (!Yii::app()->user->hasFlash('error') && $model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    Yii::app()->user->setFlash('success', 'Bạn đã đăng ký lớp học thành công. LNT sẽ sớm liên lạc lại với bạn.');
            }
        } else {
            $oldStudent = Student::model()->find('user_id=' . Yii::app()->user->id);
            if ($oldStudent) {
                $model->name = $oldStudent->name;
                $model->email = $oldStudent->email;
                $model->tel = $oldStudent->tel;
                $model->birthday = $oldStudent->birthday;
            }
        }

        $this->render('register', array('model' => $model));
    }
}
