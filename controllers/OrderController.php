<?php

namespace app\controllers;

use Yii;
use app\models\TblOrder;
use app\models\TblOrderDetail;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Alert;
use yii\data\Pagination;



/**
 * OrderController implements the CRUD actions for TblOrder model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not
        
        $model=TblOrder::find();

        $countQuery = clone $model;

        $pages = new Pagination(['totalCount' => $countQuery->count()]);

        $model = $model->offset($pages->offset)

            ->limit($pages->limit)

            ->all();
        
        return $this->render('index', [
            'model'=>$model,
            'pages'=>$pages,
        ]);
    }

    /**
     * Displays a single TblOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not
        

        return $this->render('view', [
            
            'model'=>$this->findModel($id),
        ]);
    }

    /**
     * Updates order status.
     *
     * 
     */
    public function actionChangeStatus($oid,$status)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not
                    
            $model=TblOrderDetail::find()->where(['pk_int_order_detail_id'=>$oid])->one();

            $model->fk_int_status_id=$status;

            if($model->save())
            {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Success',
                ]);
            }
            else
            {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger',
                    ],
                    'body' => 'error',
                ]);
            }
            
    }

    /**
     * Deletes an existing TblOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not
   
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblOrderDetail::find()->where(['tbl_order.pk_int_order_id'=>$id])->joinWith('fkIntOrder')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
