<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;

use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\TblProduct */
/* @var $form yii\widgets\ActiveForm */


$select2Options = [
    'multiple' => false,
    'theme' => 'krajee',
    'placeholder' => 'Type to autocomplete',
    'language' => 'en-US',
    'width' => '100%',
];

?>

<div class="tbl-product-form">

    <?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'fk_int_category_id')->dropDownList(
            ArrayHelper::map(app\models\TblCategory::find()->all(), 'pk_int_category_id','vchr_category_name'),
            ['prompt'=> 'Select a category',
             'onchange'=>'
                    $.post("index.php?r=sub-category/lists&id='.'"+$(this).val(), function(data){
                        //alert(data);
                            $("select#tblproduct-fk_int_sub_category_id").html(data);
                    });',       
            ]) ?>

    <?= $form->field($model, 'fk_int_sub_category_id')->dropDownList(
            ArrayHelper::map(app\models\TblSubCategory::find()->all(), 'pk_int_sub_category_id','vchr_sub_category_name'),
            ['prompt'=> 'Select Sub category',
                'onchange'=>'
                    $.post("index.php?r=product-size-variants/get-size&id='.'"+$(this).val(), function(data){
                        //alert(data);
                            $("select#tblproduct-fk_int_sub_category_id").html(data);
                    });',
]) ?>

        <?php /* $form->field($model, 'fk_int_sub_category_id')->widget(Select2::className(), [
            'model' => $model,
            'attribute' => 'fk_int_sub_category_id',
            'data' => \yii\helpers\ArrayHelper::map(\app\models\TblSubCategory::find()->andWhere(['fk_int_sub_category_id' => $model->fk_int_sub_category_id])->all(), 'pk_int_sub_category_id', 'vchr_sub_category_name'),
            'options' => [
                            'multiple' => false,
                            'theme' => 'krajee',
                            'placeholder' => 'Type to autocomplete',
                            'language' => 'en-US',
                            'width' => '100%',
                        ],
        ]); */?>


    <?php // $form->field($model, 'fk_int_category_id')->textInput() ?>

    <?php // $form->field($model, 'fk_int_sub_category_id')->textInput() ?>

    <?= $form->field($model, 'vchr_item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'text_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'int_item_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
