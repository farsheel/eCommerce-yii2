<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TblSubCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-sub-category-form">

    <?php $form = ActiveForm::begin(); ?>


    <?=	$form->field($model, 'fk_int_category_id')->widget(Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\app\models\TblCategory::find()->asArray()->all(), 'pk_int_category_id', 'vchr_category_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select Category ...'],   
	]);
    ?>


    <?= $form->field($model, 'vchr_sub_category_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
