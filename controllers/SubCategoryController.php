<?php

namespace app\controllers;

use Yii;
use app\models\TblSubCategory;
use app\models\SubCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SubCategoryController implements the CRUD actions for TblSubCategory model.
 */
class SubCategoryController extends Controller
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
     * Lists all TblSubCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not
        $searchModel = new SubCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblSubCategory model.
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


    public function actionLists($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

         $countSubCategory = TblSubCategory::find()
                    ->where(['fk_int_category_id'=>$id])
                    ->count();
        $subCategory = TblSubCategory::find()
                    ->where(['fk_int_category_id'=>$id])
                    ->all();
        
        if($countSubCategory> 0)
        {
            foreach ($subCategory as $subCategory) 
            {
                echo "<option value='".$subCategory->pk_int_sub_category_id."'>". $subCategory->vchr_sub_category_name."</option>";
            }
        }
        else
        {
            echo "<option>-</option>";
        }
 
    }



    /**
     * Creates a new TblSubCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        $model = new TblSubCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_int_sub_category_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblSubCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->CheckAdmin->authCheck(); // Checking the admin is logged in or not

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_int_sub_category_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblSubCategory model.
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
     * Finds the TblSubCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblSubCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblSubCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
