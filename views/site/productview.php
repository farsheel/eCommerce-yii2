<?php
use yii\bootstrap\Carousel;
use app\models\TblProduct;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">

            <div class="col-md-6">
                 <img
                  src="<?= $model->vchr_product_image ?>"
                  height=700
                  width=500
                  
                 />
            </div>
            <div class="col-md-6">
                 <div class="row">
                  <div class="col-md-12">
                   <h1><?= $model->vchr_item_name ?></h1>
                 </div>
                 <div class="row">
                 <div class="col-md-12">
                  <span class="label label-primary">Product ID</span>
                  <span class="monospaced"><?= $model->pk_int_product_id ?></span>
                 </div>
            </div>
            <div class="row">
                 <div class="col-md-12">
                  <p class="description">
                  </br></br>
                  <h3>Description</h3>
                   <?= $model->text_description ?>
                  </p>
                 </div>
            </div>
            <div class="row">
 <div class="col-md-12 bottom-rule">
  <h2 class="product-price">₹ <?= $model->int_item_price ?></h2>
 </div>
</div><!-- end row -->

<div class="row add-to-cart">

 <div class="col-md-5 product-qty">
  <?php
    echo '<label class="control-label">Quantity</label>';
    echo TouchSpin::widget([
        'name' => 'quantity',
        'readonly' => true,
        'pluginOptions' => [
                  'initval' => 1,
                  'min' => 1,
                  'max' => 10,
                  'verticalbuttons'=> true,
                  'verticalupclass'=> 'glyphicon glyphicon-plus',
                  'verticaldownclass'=> 'glyphicon glyphicon-minus',
                  
              ],
        'options' => ['placeholder' => 'Select ...',
        'id'=>'prd_qty'],
    ]);

  ?>
 

 </div>

 <div class="col-md-4">
  <button class="btn btn-lg btn-brand btn-full-width" id="btncart">
   Add to Cart
  </button>
 </div>


</div><!-- end row -->
</br>
<div id="successalert"></div>

</div>



        </div>

    </div>
</div>
<?php
$session = Yii::$app->session;
$cartCount='';
if (!$session->isActive)
            {
                // open a session
                $session->open();
            }
            $cart_data = $session->get('cart');
            if($cart_data==null)
            {
                $cartCount='0';
            }
            else
            {
                $cartCount=sizeof($cart_data);
            }

            

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    
  $(document).ready(function(){
 
    $("#btncart").click(function(){


        $("#successalert").load("index.php?r=site/add-cart&id=<?= $model->pk_int_product_id ?>&quantity="+document.getElementById('prd_qty').value);

        $("#cartcount").text("Cart(<?= $cartCount+1 ?>)");
    });
});

</script>