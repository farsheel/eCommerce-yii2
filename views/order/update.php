<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblOrder */

$this->title = 'Update Tbl Order: ' . $model->pk_int_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_int_order_id, 'url' => ['view', 'id' => $model->pk_int_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
