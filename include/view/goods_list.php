<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <title>商品一覧</title>
    <style>
        main {
            width: 100%;
        }
        .item {
            display: flex;
            /*justify-content: space-between;*/
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            text-align: center;
        }
        
        .items {
            width: 25%;
            margin-bottom: 80px;
        }

        img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <header>
        <?php include_once('layouts/user_header.php'); ?>
    </header>

    <main>
        <div id="goods_contents">
            <?php if (isset($success)): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
            
            <div class="item">
                <!--<div class="items">-->
                    <?php foreach ($items_data as $value) { ?>
                    <?php if ($value['status'] === "1") { ?>
                    <div class="items">
                        <img class="item-img" src="../images/<?php echo $value['img']; ?>" alt="image">
                        <p class="item-info">
                            <span class="item-name"><?php echo $value['item_name']; ?></span>
                            <span class="item-price">￥<?php echo $value['price']; ?></span>
                        </p>
                        <?php if ($value['stock'] !== "0") { ?>
                        <form action="goods_func.php" method="POST">
                            <input class="btn btn-secondary" type="submit" value="カートに入れる">
                            <input type="hidden" name="item_id" value="<?php echo $value['item_id']; ?>">
                        </form>
                        <?php } else { ?>
                        <p style="color: red;">売り切れです</p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php } ?>
                <!--</div>-->
                
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>