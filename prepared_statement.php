<?php

require_once __DIR__ . '/functions.php';

//デーテベースに接続
$dbh = connectDb();

//SQL文の組み立て
$sql = <<<EOM
INSERT INTO
    members
    (name, email, password)
VALUES
    (:name, :email, :password)
EOM;

//プリペアステートメントの準備
$stmt = $dbh->prepare($sql);

//パラメータのバインド(プレスホルダへの代入)
//文字列の場合: PDO::PARM_STR
//数値の場合: PDO::PARAM_INT
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

//バインド(代入)するパラメータの準備
$name = 'John';
$email = 'John@example.com';
$password = '4444';
$stmt->execute();

//バインド(代入)するパラメータの準備
$name = 'olive';
$email = 'olive@example.com';
$password = '5555';
$stmt->execute();

//SQL文のくみたて
$sql2 = 'SELECT * FROM members';

//プリペアドステートメントの準備
$stmt = $dbh->prepare($sql2);

//プリペアステートメントの実行
$stmt->execute();

//結果の受け取り
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO-INSERT3</title>
</head>
<body>
    <h2>データの登録成功</h2>
    <ul>
        <?php foreach ($members as $member): ?>
            <li><?= h($member['name']) . 'さん' ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
