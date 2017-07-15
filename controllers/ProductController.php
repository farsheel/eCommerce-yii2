<?php

namespace app\controllers;

use Yii;
use app\models\TblProduct;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for TblProduct model.
 */
class ProductController extends Controller
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
     * Lists all TblProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblProduct model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        $model = new TblProduct();

        if ($model->load(Yii::$app->request->post())) {

                $model->file=UploadedFile::getInstance($model,'file');
                $rdm=rand(0,1008);
                $imageName="upload/$model->vchr_item_name$rdm$model->file";
                $model->file->saveAs($imageName);
                $model->vchr_product_image=$imageName;

                $model->save();

            return $this->redirect(['view', 'id' => $model->pk_int_product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


                $model->file=UploadedFile::getInstance($model,'file');
                if($model->file!=null)
                {
                    $rdm=rand(0,1008);
                    $imageName="upload/$model->vchr_item_name$rdm$model->file";
                    $model->file->saveAs($imageName);
                    $model->vchr_product_image=$imageName;
                }

                $model->save();
            return $this->redirect(['view', 'id' => $model->pk_int_product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblProduct model.
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
     * Finds the TblProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
