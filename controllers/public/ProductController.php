<?php

class ProductController extends Controller
{
    public $layout = "profile";

    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('index','view','list'),
                'users'=>array('?'),
            ),
            array('allow',
                'actions'=>array('login'),
                'users'=>array('?'),
            ),
            array('allow',
                'actions'=>array('index','view','list'),
                'roles'=>array('admin'),
                //'users'=>array('*'),
            ),
            /*array('deny',
                'actions'=>array('delete'),
                'users'=>array('*'),
            ),*/
        );
    }

    public function init()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/product.css', 'screen');
    }

    public function actionIndex()
    {
        $db = Yii::app()->db;
        $sql = "SELECT * FROM {{product}}  WHERE status <>0 ORDER BY count_buy DESC LIMIT 0,8";
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        foreach ($dataReader as $item) {
            $item['url'] = $this->createUrl('/product/view', array('id' => $item['id'], 'title' => Lnt::safeTitle($item['title'])));
            $appItems[] = $item;
        }

        $thuongHieu = Term::model()->findAll('vid=7');
        $thItems = array();
        if ($thuongHieu) {

            foreach ($thuongHieu as $thItem) {
                $thItems[] = array('title' => $thItem['name'], 'value' => $thItem['id'], 'checked' => false);
            }
        }

        $cat = Term::model()->findAll('vid=6');
        $catItems = array();
        if ($cat) {
            foreach ($cat as $thItem) {
                $catItems[] = array('title' => $thItem['name'], 'value' => $thItem['id'], 'checked' => false);
            }
        }
        $this->render('index', array('items' => $appItems, 'thItems' => $thItems, 'catItems' => $catItems));
    }

    public function actionList()
    {
        $title = 'Sản phẩm';
        $criteria = new CDbCriteria(array(
            'condition' => 'status<>0',
            'order' => 'count_buy DESC',
            //'with'=>'commentCount',
        ));

        if ($_GET['catid'])
        {
            $criteria->addCondition('`cat_id` =' . $_GET['catid']);
            $term = Term::model()->findByPk($_GET['catid']);
            $title = $term->name;
        }

        $dataProvider = new CActiveDataProvider('Product', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['itemsPerPage'],
            ),
            'criteria' => $criteria,
        ));

        $thuongHieu = Term::model()->findAll('vid=7');
        $thItems = array();
        if ($thuongHieu) {

            foreach ($thuongHieu as $thItem) {
                $thItems[] = array('title' => $thItem['name'], 'value' => $thItem['id'], 'checked' => false);
            }
        }

        $cat = Term::model()->findAll('vid=6');
        $catItems = array();
        if ($cat) {
            foreach ($cat as $thItem) {
                $catItems[] = array('title' => $thItem['name'], 'value' => $thItem['id'], 'checked' => false);
            }
        }
        $this->render('list', array('items' => $dataProvider, 'title' => $title, 'thItems' => $thItems, 'catItems' => $catItems));
    }

    public function actionView()
    {
        $item = Product::model()->findByPk($_GET['id']);

        $db = Yii::app()->db;
        $sql = "SELECT * FROM {{product}}  WHERE status <>0 ORDER BY count_buy DESC LIMIT 0,8";
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        foreach ($dataReader as $ritem) {
            $ritem['url'] = $this->createUrl('/product/view', array('id' => $ritem['id'], 'title' => Lnt::safeTitle($ritem['title'])));
            $appItems[] = $ritem;
        }

        $this->render('view', array('item' => $item, 'relatedItems' => $appItems));
    }


    public function actionAddcart($id)
    {
        $this->layout = 'no';

        //$session = new CHttpSession();

        $cart = array();

        if (isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {
            $cart = unserialize(Yii::app()->session['Cart']);
            $exist = false;

            foreach ($cart as &$c) {
                if ($c['id'] == $id) {
                    $c = array(
                        'id' => $id,
                        'count' => 1,
                    );

                    $exist = true;
                }
            }

            if (!$exist) {
                $cart[] = array(
                    'id' => $id,
                    'count' => 1,
                );
            }
        } else {
            $cart[] = array(
                'id' => $id,
                'count' => 1,
            );
        }


        Yii::app()->session['Cart'] = serialize($cart);

        header("Content-Type: application/json");
        echo json_encode(array('success' => 1));
    }

    public function actionCart()
    {
        //$session = new CHttpSession();

        $cart = array();

        $items = array();

        if (isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {

            $cart = unserialize(Yii::app()->session['Cart']);

            foreach ($cart as $item) {
                $items[] = array('item' => Product::model()->findByPk($item['id']), 'count' => $item['count']);
            }
        }

        $this->render('cart', array('items' => $items));
    }

    public function actionRemove($id)
    {
        if (isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {

            $cart = unserialize(Yii::app()->session['Cart']);

            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['id'] == $id) {
                    unset($cart[$i]);
                }
            }

            Yii::app()->session['Cart'] = serialize($cart);

            header("Content-Type: application/json");
            echo json_encode(array('success' => 1));
        }
    }

    public function actionChangenum()
    {
        $id = (int)$_GET['id'];
        $count = (int)$_GET['count'];

        if ($id && $count && isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {

            $cart = unserialize(Yii::app()->session['Cart']);

            foreach ($cart as &$item) {
                if ($item['id'] == $id) {
                    $item['count'] = $count;
                }
            }

            Yii::app()->session['Cart'] = serialize($cart);

            header("Content-Type: application/json");
            echo json_encode(array('success' => 1));
        }
    }

    public function actionPay()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->user->loginRequired();
        }

        $model = Customer::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        if ($model === null) {
            $model = new Customer();
        }
        /* unset($model->attributes);
           $model->user_id  = Yii::app()->user->id; */
        // uncomment the following code to enable ajax-based validation
        /*
           if(isset($_POST['ajax']) && $_POST['ajax']==='customer-_customer-form')
           {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
          */

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];

            if ($model->validate() && $model->save()) {
                $this->redirect($this->createUrl('cartdetail'));
            }
        }

        $this->render('_customer', array('model' => $model));
    }

    public function actionCartdetail()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->user->loginRequired();
        }

        //$cart = new Order();

        $items = array();

        if (isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {

            $cart = unserialize(Yii::app()->session['Cart']);

            foreach ($cart as $item) {
                $items[] = array('item' => Product::model()->findByPk($item['id']), 'count' => $item['count']);
            }
        }

        $customer = Customer::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        $this->render('cart_detail', array('items' => $items, 'customer' => $customer));
    }

    public function actionComplete()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->user->loginRequired();
        }

        $order = new Order();

        if (isset(Yii::app()->session['Cart']) && Yii::app()->session['Cart']) {
            $cart = unserialize(Yii::app()->session['Cart']);
            $order->user_id = Yii::app()->user->id;
            $order->create_time = time();
            $total = 0;
            foreach ($cart as $item) {
                $p = Product::model()->findByPk($item['id']);
                $total += $p->price;
            }
            $order->cost = $total;

        }else{
            $this->redirect("/");
        }

        /*$customer = Customer::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($customer !== null) {
            $cart->customer_id = $customer->id;
        }*/

        if ($order->save()) {
            Yii::app()->user->setFlash('buy_complete', 'Bạn đã đặt hàng thành công. Mã đơn hàng của bạn là <b>' . $order->id . '</b>. Để nhận hàng và thanh toán vui lòng liên hệ trực tiếp với LNT.');
            unset(Yii::app()->session['Cart']);
        }
        $this->render('complete');
    }

    // Uncomment the following methods and override them if needed
    /*
     public function filters()
     {
         // return the filter configuration for this controller, e.g.:
         return array(
             'inlineFilterName',
             array(
                 'class'=>'path.to.FilterClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }

     public function actions()
     {
         // return external action classes, e.g.:
         return array(
             'action1'=>'path.to.ActionClass',
             'action2'=>array(
                 'class'=>'path.to.AnotherActionClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }
     */
}