<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php $pages->setPageSize(10); ?>

<table class="table table-striped">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Ordered by</th>
          <th>Date</th>
          <th></th>

        </tr>
      </thead>
      <tbody>

      <?php
    
      foreach ($model as $key => $value) {

          $completedOrderFlag=0;
          $completedOrder=\app\models\TblOrderDetail::find()->where(['fk_int_order_id'=>$value->pk_int_order_id])->all();
         foreach ($completedOrder as $orderDetail) {
           if($orderDetail->fk_int_status_id==4)
           {
              $completedOrderFlag=1;
           }
           else
           {
              $completedOrderFlag=0;
              break;
           }
         }

      ?>

        <tr>
          <td <?php if($completedOrderFlag==1) echo 'class="btn-success"'; else echo 'class="btn-danger"';?>> <?= $value->pk_int_order_id ?></td>
          <td <?php if($completedOrderFlag==1) echo 'class="btn-success"'; else echo 'class="btn-danger"';?>><?= $value->fkIntUser->vchr_name ?> </td>
          <td <?php if($completedOrderFlag==1) echo 'class="btn-success"'; else echo 'class="btn-danger"';?>> <?= $value->date_date ?></td>
          <th><a href="index.php?r=order/view&id=<?= $value->pk_int_order_id ?>">View</a></th>
          
        </tr>

        <?php
         }

        ?>
      </tbody>

  </table>
  <?= LinkPager::widget([
    'pagination' => $pages,
]); ?>
</div>
