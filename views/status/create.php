<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblStatus */

$this->title = 'Create Tbl Status';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
