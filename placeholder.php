<?php

require_once __DIR__ . '/functions.php';

//データベースに接続
$dbh = connectDb();

//SQL文の組み立て
$sql = <<<EOM
INSERT INTO
    members
    (name, email, password)
VALUES
    ('test', 'test@test.com', '0000')
EOM;

$stmt = $dbh->prepare($sql);
$stmt->execute();

//SQL文のくみたて
$sql2 = 'SELECT * FROM members';

//プリペアドステートメントの準備
$stmt = $dbh->prepare($sql2);

//プリペアドの実行
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
    <title>PDO - INSERT2</title>
</head>
<body>
    <h2>データ登録成功</h2>
    <ul>
        <?php foreach ($members as $member): ?>
            <li><?= h($member['name']) . 'さん' ?></li>
        <?PHP endforeach; ?>
    </ul>
</body>
</html>