<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblOrder */

//$this->title = $model->pk_int_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="tbl-order-view">
    <div class="row">
        <div class="col-sm-2" align="center">
        </div>
            <div class="col-sm-8">
               <div class="row">

<?php

foreach ($model as $key => $value) {
    ?>

    <div class=" highlight" style="margin-left:0;" align="center">
    <hr>
                        <h2><?= $value['fkIntProduct']['vchr_item_name'] ?></h2>
                    <?php
                    
                    ?>
                    <div class="row">  
                    
                        <img src ="<?= $value->fkIntProduct->vchr_product_image ?>" width="100" height="100"/>                    
                    </div>
                    <div class="row">        
                        Customer Name: <?= $value->fkIntOrder->fkIntUser->vchr_name ?> 

                     </div>
                     <div class="row btn-success">        
                        Order Date: <?= $value->fkIntOrder->date_date ?> 
                     </div>
                     <div class="row btn-danger">        
                        Shipping Address: <?= nl2br($value->fkIntOrder->fkIntUser->text_address) ?> 
                     </div>
                    <div class="row">
                        <p>Current Status:<a id="currentstatus-<?= $value->pk_int_order_detail_id ?>"> <?= $value->fkIntStatus->vchr_status?> </a></p>
                    
                        Update Status:<a class = "btn btn-primary" id="btnpending-<?= $value->pk_int_order_detail_id ?>">Pending</a>
                       <a class = "btn btn-warning" id="btnaccept-<?= $value->pk_int_order_detail_id ?>">Accepted</a>
                       <a class = "btn btn-success" id="btnshipped-<?= $value->pk_int_order_detail_id ?>">Shipped</a>
                       <a class = "btn btn-danger" id="btncomplete-<?= $value->pk_int_order_detail_id ?>">Completed</a>
                       <div id="successalert-<?= $value->pk_int_order_detail_id ?>"></div>
                       <hr>
                    </div>
                </div>

                <script type="text/javascript">

  $(document).ready(function(){
 
    $("#btnpending-<?= $value->pk_int_order_detail_id ?>").click(function(){
        $("#successalert-<?= $value->pk_int_order_detail_id ?>").load("index.php?r=order/change-status&oid=<?= $value->pk_int_order_detail_id ?>&status=1");
        $("#currentstatus-<?= $value->pk_int_order_detail_id ?>").text("Pending");       
    });
    $("#btnaccept-<?= $value->pk_int_order_detail_id ?>").click(function(){
        $("#successalert-<?= $value->pk_int_order_detail_id ?>").load("index.php?r=order/change-status&oid=<?= $value->pk_int_order_detail_id ?>&status=2");
        $("#currentstatus-<?= $value->pk_int_order_detail_id ?>").text("Accepted");        
    });
    $("#btnshipped-<?= $value->pk_int_order_detail_id ?>").click(function(){
        $("#successalert-<?= $value->pk_int_order_detail_id ?>").load("index.php?r=order/change-status&oid=<?= $value->pk_int_order_detail_id ?>&status=3");
        $("#currentstatus-<?= $value->pk_int_order_detail_id ?>").text("Shipped");        
    });
    $("#btncomplete-<?= $value->pk_int_order_detail_id ?>").click(function(){
        $("#successalert-<?= $value->pk_int_order_detail_id ?>").load("index.php?r=order/change-status&oid=<?= $value->pk_int_order_detail_id ?>&status=4");
        $("#currentstatus-<?= $value->pk_int_order_detail_id ?>").text("Completed");        
    });
});

</script>
<?php

}

?>
                   
            </div>
        </div>           
    </div> 
</div>
