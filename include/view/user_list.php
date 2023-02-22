<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <title>ユーザー管理</title>
    <style type="text/css">
        table, td, th {
            border: solid black 1px;
            text-align: center;
        }
        table {
            width: 1000px;
            border-collapse: collapse;
            /*margin: 0 auto;*/
        }
        #users {
            padding-left: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>ユーザー管理ページ</h1>
        <nav>
            <ul>
                <li><a href="logout_func.php">ログアウト</a></li>
                <li><a href="admin.php">商品管理ページ</a></li>
            </ul>
        </nav>
    </header>
    <div id="users">
        <h2>ユーザー情報一覧</h2>
        <table>
            <thead>
                <tr>
                    <th>ユーザーID</th>
                    <th>登録日</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_data as $value) { ?>
                <tr>
                    <td><?php print $value['user_name']; ?></td>
                    <td><?php print $value['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>