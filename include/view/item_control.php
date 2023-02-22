<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <title>商品管理</title>
    <style>
        table, td, th {
            border: solid black 1px;
            text-align: center;
        }
        table {
            width: 1200px;
            border-collapse: collapse;
            /*margin: 0 auto;*/
        }
        img {
            width: 200px;
        }
        .register {
            margin: 0 auto 30px auto;
            width: 400px;
        }

        .index {
            padding-left: 30px;
            margin-bottom: 50px;
        }

        .numberInput {
            width: 100px;
            margin-left: 50px;
            margin-bottom: 15px;
        }
        
        .stock {
            width: 200px;
        }

        /*bootstarp*/
        .register .form-control, .form-select {
            width: 300px;
        }
    </style>
</head>
<body>
    <header>
        <h1>商品管理ページ</h1>
        <nav>
            <ul>
                <li><a href="logout_func.php">ログアウト</a></li>
                <li><a href="user.php">ユーザー管理ページ</a></li>
            </ul>
        </nav>
    </header>

    <?php if (count($errors) > 0): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <!--商品追加-->
    <div class="register">
        <h2>商品の登録</h2>
        <form method="POST" action="admin_create.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="item_name" class="form-label">商品名</label>
                <input type="text" name='item_name' class="form-control" id="item_name" placeholder="例）りんご、キャンディー">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">値段</label>
                <input type="number" name='price' min="0" class="form-control" id="price" placeholder="例）1000 *半角数字">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">個数</label>
                <input type="number" name="stock" min="1" class="form-control" id="stock" placeholder="例）1, 100 *半角数字">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">商品画像</label>
                <input name="img" class="form-control form-control-sm" id="img" type="file">
            </div>
            <div class="mb-3">
                <label for="status">ステータス： </label>
                <select name="status" id="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="" selected>商品ステータスを選択してください</option>
                    <option value="1">公開</option>
                    <option value="0">非公開</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">商品を登録</button>
        </form>
    </div>

    <!--商品リスト-->
    <div class="index">
        <h2>商品情報の一覧・変更</h2>
        <table>
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>ステータス</th>
                <th>操作</th>
            </tr>

            <?php foreach ($items_data as $value) { ?>
            <tr>
                <td class="img"><img src="../images/<?php print $value['img']; ?>" alt="image"></td>
                <td><?php print $value['item_name']; ?></td>
                <td><?php print $value['price']; ?>円</td>
                <td class=stock>
                    <form method="post" action='admin_update_stock.php'>
                        <input type="number" name="stock" min="0" class="form-control numberInput" value="<?php print $value['stock']; ?>">
                        <input type="submit" value="変更" class="btn btn-secondary"/>
                        <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                    </form>
                </td>
                <td>
                    <form method="post" action='admin_update_status.php'>
                        <?php if ($value['status'] === '1') { ?>
                            <input type="submit" value="非公開にする" class="btn btn-outline-secondary">
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        <?php } else { ?>
                            <input type="submit" value="公開にする" class="btn btn-secondary">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                        <?php } ?>
                    </form>
                </td>
                <td>
                    <form method="post" action="admin_delete.php">
                        <input type="submit" value="削除" class="btn btn-danger">
                        <input type="hidden" name="img" value="<?php print $value['img'] ?>">
                        <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                    </form>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>