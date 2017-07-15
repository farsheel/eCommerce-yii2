<?php
use yii\bootstrap\Carousel;
use app\models\TblProduct;
use kartik\touchspin\TouchSpin;

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
        <button type="button" class="btn btn-danger" id="btnclear">Clear Cart</button>      

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


      <?php
    
      
      $totalPrice=0;

      foreach ($allItems as $key => $value) {
       
       $price=$value->int_item_price*$cart_data[$key]['quantity'];
       $totalPrice=$totalPrice+$price;
     
      ?>
        <tr>
          <td><img height="50" width="50" src="<?= $value->vchr_product_image ?>"> <?= $value->vchr_item_name ?></td>
          <td>

          <?php
            echo TouchSpin::widget([
              'name' => 'quantity'.$key,
              'options' => ['placeholder' => 'Select ...','size'=>1,
              'id'=>'prd_qty'.$key],
              'readonly' => true,
              'pluginOptions' => [
                  'initval' => $cart_data[$key]['quantity'],
                  'min' => 1,
                  'max' => 10,
                  'verticalbuttons'=> true,
                  'verticalupclass'=> 'glyphicon glyphicon-plus',
                  'verticaldownclass'=> 'glyphicon glyphicon-minus',
                  
              ],
              'pluginEvents'=>[
                'change'=>'function() { updatePrice(this.value,'.$key.');}',

              ]
          ]);
          ?>

          </td>
          <td id="price<?= $key ?>"><?= $price ?></td>
        </tr>
        <?php
         }
         
        ?>
      </tbody>
      <td>Total</td>
      <td>Total=</td>
      <td id="total"><?= $totalPrice ?></td>
  </table>    

            <div id="successalert"></div>

        </div>
                <a type="button" href=index.php?r=site/checkout class="btn btn-success" id="btnclear">Checkout</a>      

  </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">



function updatePrice(qty,key)
{

  $("#successalert").load("index.php?r=site/add-cart&id="+key+"&quantity="+qty);
   
   location.reload();
      

}

    
  $(document).ready(function(){

    $("#btnclear").click(function(){


        $("#successalert").load("index.php?r=site/clear-cart");

        $("tbody").text("");

        $("#cartcount").text("Cart()");
    });

    


});

</script>