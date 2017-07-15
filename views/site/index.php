<?php
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron">
        <?= Carousel::widget([
    'items' => [
        [
            'content' => '<img src="upload/banner1.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
        ],
        [
            'content' => '<img src="upload/banner1.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
        ],
        [
            'content' => '<img src="upload/banner1.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
        ],

    ],
    'controls'=>['&lsaquo;', '&rsaquo;'],


]); ?>
    </div>

    <div class="body-content">

        <div class="row">

        <?php


        $model = app\models\TblProduct::find()->orderBy([
                                                   'pk_int_product_id'=>SORT_DESC,
                                                        ])->all();

        function lchar($str,$val)
        {
            return strlen($str)<=$val?$str:substr($str,0,$val).'...';
        }

        foreach ($model as $model) {
            
        

        ?>

            <div class="col-lg-4">
            <img src="<?= $model->vchr_product_image ?>" height="200" width="200">
                <h4><?= $model->vchr_item_name ?> </h4>

                <p><?= lchar($model->text_description,100) ?></p>

                <p><a class="btn btn-default" href="index.php?r=site/product-view&id=<?= $model->pk_int_product_id ?> ">View &raquo;</a></p>
            </div>
            <vr/>
            <?php
            }
             ?>
            

    </div>
</div>
