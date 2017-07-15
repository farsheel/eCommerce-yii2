<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblOrder */

$this->title = 'Create Tbl Order';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
