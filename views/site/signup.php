<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsers */
/* @var $form ActiveForm */
?>
<div class="site-signup">
<div class="col-sm-3">
    
</div>
<div class="col-sm-6">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'vchr_name') ?>
        <?= $form->field($model, 'vchr_gender')->radioList(array('Male'=>'Male','Female'=>'Female','Other'=>'Other')) ?>
        <?= $form->field($model, 'vchr_mobile') ?>
        <?= $form->field($model, 'vchr_email') ?>
        <?= $form->field($model, 'vchr_password') ?>
        <?= $form->field($model, 'text_address')->textarea(['rows' => '6']) ?>
        <p>by clicking signup, you agree to our terms and conditions</p>
        <div class="form-group" align="center">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary']) ?>
        </div>


    <?php ActiveForm::end(); ?>
</div>

</div><!-- site-signup -->
