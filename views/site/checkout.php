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
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>

        </tr>
      </thead>
      <tbody>

<?php $form = ActiveForm::begin(); ?>
      <?php
    
    
      
      $totalPrice=0;

      foreach ($allItems as $key => $value) {
       
       $price=$value->int_item_price*$cart_data[$key]['quantity'];
       $totalPrice=$totalPrice+$price;
     
      ?>
        <tr>
          <td><img height="50" width="50" src="<?= $value->vchr_product_image ?>"> <?= $value->vchr_item_name ?></td>
          <td>

        <?= $cart_data[$key]['quantity'] ?>

          </td>
          <td id="price<?= $key ?>"><?= $price ?></td>
        </tr>

        <input type="hidden" name="prdqty[<?= $key ?>]" value="<?= $cart_data[$key]['quantity'] ?>">
        <?php
         }

        ?>
      </tbody>
      <td>Total</td>
      <td>Total=</td>
      <td id=totalprice><?= $totalPrice ?></td>
  </table>    

            <div id="successalert"></div>

        </div>
                <?= Html::submitButton('Place Order', ['class' => 'btn btn-success']) ?> 
                <?php ActiveForm::end(); ?>   

  </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
