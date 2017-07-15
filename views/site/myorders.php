<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Home';
?>

<div class="site-index">

<?php
$session = Yii::$app->session;
            if (!$session->isActive)
            {
                $session->open();
            }
            $cart_data = $session->get('cart');

        

?>
    <div class="body-content">

        <div class="row">

        <table class="table table-striped">
      <thead>
        <tr>
          <th>Order</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Status</th>

        </tr>
      </thead>
      <tbody>

      <?php
    
    
      
      

      foreach ($model as $key => $value) {
       
       $prdprice=$value->fkIntProduct->int_item_price*$value->int_quantity;
     
      ?>
        <tr>
          <td> <?= $value->fk_int_order_id ?></td>
          <td><?= $value->fkIntProduct->vchr_item_name ?> </td>
          <td> <?= $prdprice ?></td>
          <td> <?= $value->fkIntStatus->vchr_status ?></td>
        </tr>

        <?php
         }

        ?>
      </tbody>

  </table>    

  

        </div>
                

  </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
