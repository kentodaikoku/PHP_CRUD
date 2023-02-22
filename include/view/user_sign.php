<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <title>ユーザー登録</title>
    <style type="text/css">
        h2, #sign_up, .links {
            padding-left: 30px;
            margin-bottom: 20px;
        }
        .form-control {
            width: 500px;
        }
    </style>
</head>
<body>
    <header>
        <?php include_once('layouts/unlogined_header.php'); ?>
    </header>
    
    <h2>ユーザー新規作成</h2>
    
    <?php if (count($err) > 0) { ?>
        <?php foreach ($err as $value) { ?>
            <p class="error"><?= $value; ?></p>
        <?php } ?>
    <?php } ?>
    
    <div id="sign_up">
        <form method="POST" action="sign.php">
            <div class="mb-3">
                <label for="user" class="form-label">ユーザー名</label>
                <input name="user_name" type="text" class="form-control" id="user" placeholder="user_name" value="<?php print $user_name ?>">
            </div>
            <div class="mb-3">
                <label for="passwd" class="form-label">パスワード</label>
                <input type="password" name="passwd" class="form-control" id="passwd" placeholder="password">
            </div>
            <input type="submit" value="新規作成する" class="btn btn-primary"/><br>
        </form>
    </div>
    
    <div class="links">
        <a href="login.php">ログインページ</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>