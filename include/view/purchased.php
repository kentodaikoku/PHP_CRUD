<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <link rel="stylesheet" href="../css/cart.css">
    <title>購入完了</title>
    <style>
      .finish-msg {
        text-align: center;
        margin-bottom: 30px;
      }
      
      .finish-msg p{
        font-size: 2.5rem;
        background-color: #96E9EB;
        color: #ff6347;
      }
      
      .item-left{
        position: relative;
      }
      
      .item-left span {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translate(0, -50%);
      }
      
      .item-right {
        margin-right: 160px;
      }
      
      .itemPrice {
        margin-right: 100px;
      }
    </style>
</head>
<body>
    <header>
      <?php include_once('layouts/user_header.php'); ?>
    </header>
    
    <div class="cart_contents">
      
      <div class="finish-msg">
        <p>ご購入ありがとうございました。</p>
      </div>
      
      <div class="cart-list-title">
        <span class="cart-list-price">価格</span>
        <span class="cart-list-num">数量</span>
      </div>
      
      <div class="item-contents"> <!--縦並び-->
      <?php foreach ($purchased_data as $value) { ?>
        <div class="cart-item"> <!--横並び-->
          <div class="item-left">
            <img src="../images/<?php echo $value['img']; ?>">
            <span style="font-size: 20px;"><?php echo $value['item_name']; ?></span>
          </div>
          <div class="item-right">
            <span class="itemPrice">￥<?php echo $value['price']; ?></span>
            <span class="itemamount"><?php echo $value['amount']; ?>個&nbsp;</span>
          </div>
        </div>
      <?php } ?>
      </div>
      
      <div class="buy-contents">
        <span class="buy-title">合計</span>
        <span class="buy-price">￥<?php echo $total_price; ?></span>
      </div>
    </div>
</body>
</html>