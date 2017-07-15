<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();

    //registering css required for hover menu
    $this->registerCss("
.dropbtn {
    background-color: #131512;
    color: white;
    padding: 15px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}


.dropdown {
    position: relative;
    display: inline-block;
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}


.dropdown-content a {
    color: black;
    padding: 8px 8px;
    text-decoration: none;
    display: block;
}


.dropdown-content a:hover {background-color: #A8B9A8}


.dropdown:hover .dropdown-content {
    display: block;
}


.dropdown:hover .dropbtn {
    background-color: #222222;
    color: white;
    size:20;
}");


    ?>

</head>
<body>
<?php $this->beginBody() ?>



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
<div class="wrap">
<div class="row">
    <?php

$menu_bar='<div class="navbar-nav navbar-right">';
if(!Yii::$app->user->isGuest)
{
    $menu_bar=Yii::$app->user->identity->int_user_type==1 ?($menu_bar.""): ($menu_bar.
        '<div class="dropdown">
              <button class="dropbtn">Master Entries</button>
              <div class="dropdown-content">
                <a href="index.php?r=category/index">Manage Category</a>
                <a href="index.php?r=sub-category/index">Manage Sub-Category</a>
              </div>
    </div>');
    $menu_bar=Yii::$app->user->identity->int_user_type==1 ?($menu_bar.""): ($menu_bar.
        '<div class="dropdown">
              <button class="dropbtn">Manage Orders</button>
              <div class="dropdown-content">
                <a href="index.php?r=order/index">Orders</a>
                
              </div>
    </div>');
    $menu_bar=Yii::$app->user->identity->int_user_type==1?($menu_bar.""): ($menu_bar.
        '<div class="dropdown">
              <button class="dropbtn">Manage Products</button>
              <div class="dropdown-content">
                <a href="index.php?r=product/index">Products</a>
              </div>
    </div>');

    $menu_bar=(Yii::$app->user->identity->int_user_type==0)?($menu_bar.""): ($menu_bar.
        '<div class="dropdown">
            <div class="dropbtn">
                <a style="color:white;text-decoration:none"href="index.php?r=site/cart" id="cartcount">Cart('.$cartCount.')</a>
              </div>
    </div>');
    $menu_bar=(Yii::$app->user->identity->int_user_type==0)?($menu_bar.""): ($menu_bar.
        '<div class="dropdown">
            <div class="dropbtn">
                <a style="color:white;text-decoration:none"href="index.php?r=site/my-orders">My Orders</a>
              </div>
    </div>');
}

$menu_bar=(Yii::$app->user->isGuest)?($menu_bar.'

    <div class="dropdown">
        <div class="dropbtn">
            <a style="color:white;text-decoration:none"href="index.php?r=site/login">Login</a>
          </div>
</div>'):
        ($menu_bar.
            '<div class="dropdown">
                <div>'.
                Html::beginForm(['/site/logout'], 'post').'
                    <button type="submit" class="dropbtn" onclick=submit()>Logout('.Yii::$app->user->identity->vchr_email.')</button>'.Html::endForm().'
                  </div>
        </div>');

$menu_bar.='</div>';


    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png',['alt'=>'PreShop','width'=>'40','height'=>'40']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
            'style'=>'height:60px;background-color:#717274',
        ],
    ]);
    echo  "<form class='navbar-form navbar-right' action='index.php'>
      <div class=form-group>
        <input type=hidden name=r value=site/search>
        <input type=text class=form-control placeholder=Search name=q>
      </div>
      <button type=submit class='btn btn-success'>
<span class='glyphicon glyphicon-search'></span>
</button>
    </form>";

    echo Nav::widget([
        'options' => [
        'class' => 'navbar-nav navbar-right navbar-inverse'],
    ]);
        echo $menu_bar;

   
    NavBar::end();
    ?>

</div>


    <div class="container">
 <?php
$catMenuModel=app\models\TblCategory::find()->all();
$catMenu='<div class="navbar-nav navbar-inverse">';

foreach ($catMenuModel as $catValue) {
    $catMenu.='<div class="dropdown">';
    $catMenu.='<button class="dropbtn">'.$catValue->vchr_category_name.'</button>
              <div class="dropdown-content">';

    $catSubMenuModel=app\models\TblSubCategory::find()->where(['fk_int_category_id'=>$catValue->pk_int_category_id])->all();

    foreach ($catSubMenuModel as $subMenuValue) {
        $catMenu.='<a href="index.php?r=site/search&q='.$subMenuValue->vchr_sub_category_name.'">'.$subMenuValue->vchr_sub_category_name.'</a>
              ';

    }
    $catMenu.='</div>';
       
}
 
$catMenu.='</div>';
$catMenu.='</div>';
 NavBar::begin();
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
]);

echo $catMenu;
echo "</div>";
NavBar::end();
 ?>


        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) 
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
