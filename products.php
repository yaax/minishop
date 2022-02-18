<?php
include_once "init.php";
use ProductModel\ProductModel;
$products = ProductModel::getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="products.css" />
</head>
<body>
<div class="container mydiv">
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="bbb_deals">
                <? if ($product->getSale()): ?>
                <div class="ribbon ribbon-top-right"><span>Sale</span></div>
                <? endif; ?>
                <div class="bbb_deals_title"><?=$product->getTitle(); ?></div>
                <div class="bbb_deals_slider_container">
                    <div class=" bbb_deals_item">
                        <div class="bbb_deals_image"><img src="<?=$product->getImageUrl(); ?>" alt=""></div>
                        <div class="bbb_deals_content">
                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
	                            <? if ($product->getSale()): ?>
                                <!--<div class="bbb_deals_item_category"><a href="#">Laptops</a></div>  -->
                                <div class="bbb_deals_item_price_a ml-auto"><strike>$<?=$product->getSalePrice(); ?></strike></div>
	                            <? endif; ?>
                            </div>
                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                <div class="bbb_deals_item_name"><?=$product->getDescription(); ?></div>
                                <div class="bbb_deals_item_price ml-auto">$<?=$product->getPrice(); ?></div>
                            </div>
                            <?foreach ($product->getAttributes() as $attribute): ?>
                            <div class="available">
                                <div class="available_line d-flex flex-row justify-content-start">
                                    <div class="available_title"><?=$attribute->getName(); ?>: <span><?=$attribute->getValue(); ?></span></div>
                                </div>
                            </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    </div>
</div>
</body>
</html>

<!--
<div class="col-md-4">
<div class="bbb_deals">
    <div class="ribbon ribbon-top-right"><span><small class="cross">x </small>2</span></div>
    <div class="bbb_deals_title">Today's Combo Offer</div>
    <div class="bbb_deals_slider_container">
        <div class=" bbb_deals_item">
            <div class="bbb_deals_image"><img src="https://i.imgur.com/9UYzfny.png" alt=""></div>
            <div class="bbb_deals_content">
                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                    <div class="bbb_deals_item_category"><a href="#">Laptops</a></div>
                    <div class="bbb_deals_item_price_a ml-auto"><strike>₹40,000</strike></div>
                </div>
                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                    <div class="bbb_deals_item_name">HP Envy</div>
                    <div class="bbb_deals_item_price ml-auto">₹35,550</div>
                </div>
                <div class="available">
                    <div class="available_line d-flex flex-row justify-content-start">
                        <div class="available_title">Available: <span>6</span></div>
                        <div class="sold_stars ml-auto"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                    </div>
                    <div class="available_bar"><span style="width:17%"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-4">
    <div class="bbb_deals">
        <div class="ribbon ribbon-top-right"><span><small class="cross">x </small>3</span></div>
        <div class="bbb_deals_title">Today's Combo Offer</div>
        <div class="bbb_deals_slider_container">
            <div class=" bbb_deals_item">
                <div class="bbb_deals_image"><img src="https://i.imgur.com/9UYzfny.png" alt=""></div>
                <div class="bbb_deals_content">
                    <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                        <div class="bbb_deals_item_category"><a href="#">Laptops</a></div>
                        <div class="bbb_deals_item_price_a ml-auto"><strike>₹30,000</strike></div>
                    </div>
                    <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                        <div class="bbb_deals_item_name">Toshiba B77</div>
                        <div class="bbb_deals_item_price ml-auto">₹27,550</div>
                    </div>
                    <div class="available">
                        <div class="available_line d-flex flex-row justify-content-start">
                            <div class="available_title">Available: <span>6</span></div>
                            <div class="sold_stars ml-auto"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                        </div>
                        <div class="available_bar"><span style="width:17%"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
