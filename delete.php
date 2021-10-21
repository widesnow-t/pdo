<?php

require_once __DIR__ . '/functions.php';

//データベースに接続
$dbh =connectDb();

//削除対象のidの定義
$id = 1;

//SQL文の組み立て
$sql = <<<EOM
DELETE FROM
    members
WHERE
    id = :id
EOM;

//ブリベアドステートメントの準備
$stmt = $dbh->prepare($sql);

//パラメータのバインド
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

//ブリベアドステートメントの実行
$stmt->execute();

//SQL文の組み立て
$sql2 = 'SELECT * FROM members';

//ブリベアドステートメントの準備
$stmt = $dbh->prepare($sql2);

//ブリベアドステートメントの実行
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
    <title>PDO - DELETE</title>
</head>
<body>
    <h2>デーテの削除成功</h2>
    <ul>
        <?php foreach ($members as $member): ?>
            <li><?= h($member['name']) . 'さん' ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>