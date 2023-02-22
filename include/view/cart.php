<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <link rel="stylesheet" href="../css/cart.css">
    <title>カート</title>
</head>
<body>
    <header>
      <?php include_once('layouts/user_header.php'); ?>
    </header>

    <?php if (isset($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <div class="cart_contents">
        <h2 class="title">ショッピングカート</h2>

        <div class="cart-list-title">
          <span class="cart-list-price">価格</span>
          <span class="cart-list-num">数量</span>
        </div>

        <div class="item-contents"> <!--縦並び-->
        <?php foreach ($cart_data as $value) { ?>
          <div class="cart-item"> <!--横並び-->
            <div class="item-left">
              <img src="../images/<?php echo $value['img']; ?>">
              <span style="font-size: 20px;"><?php echo $value['item_name']; ?></span>
            </div>
            <div class="item-right">
              <form action="cart_delete.php" class="itemDelete" method="post">
                <input type="submit" class="btn btn-danger" value="削除">
                <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                <input type="hidden">
              </form>
              
              <span class="itemPrice">￥<?php echo $value['price']; ?></span>
              
              <form action="cart_update.php" class="itemUpdate" method="post">
                <span class="itemAmount"><input type="number" min="1"  class="form-control" name="amount" value="<?php echo $value['amount']; ?>">個&nbsp;</span>
                <input type="submit" class="btn btn-secondary" value="変更">
                <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                <input type="hidden">
              </form>
            </div>
          </div>
        <?php } ?>
        </div>
        
        
        <div class="buy-contents">
          <span class="buy-title">合計</span>
          <span class="buy-price">￥<?php echo $total_price; ?></span>
        </div>
        <div class="buy-btn">
          <form action="purchased_func.php" method="post">
            <input class="btn btn-primary" type="submit" value="購入する">
          </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>