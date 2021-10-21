<?php

require_once __DIR__ . '/functions.php';

//データベースに接続
$dbh = connectDb();

//sql文の組み立て
$sql = 'SELECT * FROM members';

//ブリペアドステートメントの準備
//$dbh->query($sql)でも良い
$stmt = $dbh->prepare($sql);

//ブリペアステートメントの実行
$stmt->execute();

//結果の受け取り
$members = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - SELECT</title>
</head>
<body>
    <h2>データの抽出成功</h2>
    <ul>
        <?php foreach ($members as $member): ?>
            <li><?= h($member['name']) . 'さん' ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>