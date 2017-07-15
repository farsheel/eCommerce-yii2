<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblStatus */

$this->title = 'Update Tbl Status: ' . $model->pk_int_status_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_int_status_id, 'url' => ['view', 'id' => $model->pk_int_status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
