<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TblProduct;
use app\models\TblOrder;
use app\models\TblUsers;
use app\models\TblOrderDetail;
use yii\bootstrap\Alert;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Adds Product to cart.
     *
     * @return string
     */
    public function actionAddCart($id,$quantity)
    {
        
        $session = Yii::$app->session;

         // check if a session is already open
            if (!$session->isActive)
            {
                // open a session
                $session->open();
            }
            $cart_data = $session->get('cart');
            $cart_data[$id]=array('quantity' => $quantity);
            $session->set('cart', $cart_data);



                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Successfully updated cart',
                ]);



    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Displays Myorders Page.
     *
     * @return string
     */
    public function actionMyorders()
    {
        if(Yii::$app->user->isGuest)
        {
            return Yii::$app->getResponse()->redirect(['site/login']);
        }

        $model=TblOrderDetail::find()->joinWith('fkIntOrder', true)->joinWith('fkIntProduct', true)->where(['tbl_order.fk_int_user_id'=>Yii::$app->user->identity->pk_int_user_id])->all();


        return $this->render('myorders', [
            'model'=>$model
        ]);
    }

    /**
     * Displays checkout page.
     *
     * @return string
     */
    public function actionCheckout()
    {
        if(Yii::$app->user->isGuest)
        {
            return Yii::$app->getResponse()->redirect(['site/login']);
        }

        $model=new TblProduct();
        $cid=Yii::$app->user->identity->pk_int_user_id;



    if(Yii::$app->request->post())
     {
        $order=new TblOrder();
        $order->fk_int_user_id=$cid;        
        $order->save(false);
        

        foreach (Yii::$app->request->post("prdqty") as $prd => $qty) {
            
            $orderDetail=new TblOrderDetail();
            
            $orderDetail->fk_int_order_id=$order->getPrimaryKey();
            $orderDetail->fk_int_product_id=$prd;
            $orderDetail->int_quantity=$qty;
            $orderDetail->fk_int_status_id=1;
            $orderDetail->save(false);            
        }
            $session = Yii::$app->session;
                if (!$session->isActive)
                {
                    $session->open();
                }
                unset($_SESSION['cart']);
        return $this->redirect(['myorders']);
     }


        $allItems=array();
         $session = Yii::$app->session;
            if (!$session->isActive)
            {
                $session->open();
            }
            $cart_data = $session->get('cart');

             if($cart_data!=0)
                {
        
                    foreach ($cart_data as $key => $value) {
                        
                        $current=TblProduct::find()->where([
                                                'pk_int_product_id'=>$key,
                                                                    ])->one();
                        $allItems[$key]=$current;
         }
     }

        return $this->render('checkout', [
            'allItems'=>$allItems,

        ]);
    }


    /**
     * Clears Cart session.
     *
     * 
     */
    public function actionClearCart()
    {
        
            $session = Yii::$app->session;
            if (!$session->isActive)
            {
                $session->open();
            }
            unset($_SESSION['cart']);
                    
            
            
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Successfully cleared cart',
                ]);
            
    }

    /**
     * Displays Cart Page.
     *
     * @return string
     */
    public function actionCart()
    {
        //$model=new TblProduct();


        $allItems=array();
         $session = Yii::$app->session;
            if (!$session->isActive)
            {
                $session->open();
            }
            $cart_data = $session->get('cart');

             if($cart_data!=0)
                {
        
                    foreach ($cart_data as $key => $value) {
                        
                        $current=TblProduct::find()->where([
                                                'pk_int_product_id'=>$key,
                                                                    ])->one();
                        $allItems[$key]=$current;
         }
     }





        return $this->render('cart', [
            'allItems'=>$allItems
        ]);
    }


    /**
     * Displays Product Page.
     *
     * @return string
     */
    public function actionProductView($id)
    {
        //$model=new TblProduct();
        
        $model =TblProduct::find()->where([
                                    'pk_int_product_id'=>$id,
                                                        ])->one();


        return $this->render('productview', [
            'model'=>$model
        ]);
    }

    /**
     * signup action.
     *
     * 
     */
    public function actionSignup()
    {
        
        $model = new TblUsers();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                return $this->redirect(['myorders']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays search page.
     *
     * @return string
     */
    public function actionSearch($q=null)
    {
        $model =TblProduct::find()
                                            ->joinWith('fkIntCategory')
                                            ->joinWith('fkIntSubCategory')
                                            ->orderBy([
                                                   'pk_int_product_id'=>SORT_DESC,
                                                        ])                                           
                                            ->all();
        if($q!=null)
        {
            $model = TblProduct::find()
                                            ->joinWith('fkIntCategory')
                                            ->joinWith('fkIntSubCategory')
                                            ->orFilterWhere(['like','vchr_item_name',$q])
                                            ->orFilterWhere(['like','tbl_category.vchr_category_name',$q])
                                            ->orFilterWhere(['like','tbl_sub_category.vchr_sub_category_name',$q])
                                            ->orFilterWhere(['like','text_description',$q])
                                            ->orderBy([
                                                   'pk_int_product_id'=>SORT_DESC,
                                                        ])                                           
                                            ->all();   
        }
        return $this->render('search', [
            'model' => $model,
        ]);

    }
    
}
