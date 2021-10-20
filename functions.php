<?php
//設定ファイルを読み込む
require_once __DIR__ . '/config.php';

//接続処理を行う関数
function connectDb()
{
    //tyr ~ catch 構文
    try{
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        //接続がうまく行かない場合こちらの処理が実行される
        echo $e->getMessage();
        exit;
    }
}

//エスケープ処理を行う関数
function h($str)
{
    //ENT_QUOTES: シングルコートとダブルクオートを共に変換する｡
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}