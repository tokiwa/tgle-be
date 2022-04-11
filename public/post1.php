<?php
/**
 * @param string $url 送信先のURL
 * @param string $data json形式のデータ
 * @return string リクエストのレスポンス
 */
// 参考　https://www.smartllc.jp/blog/20150811-how-to-post-json-in-php/

function postJson($url, $data){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result=curl_exec($ch);
    echo 'RETURN:'.$result;
}

echo "<h1>post1.php @ /g/tgle3be/public</h1>";
$json = '{
"groupKeyword":["プライバシー", "セキュリティ", "著作権"],
"student":[
    ["個人情報", "非公開", "インフォーマル"],
    ["私生活", "保障", "匿名"],
    ["個人情報保護", "保護", "漏えい"],
    ["安全", "警備", "保安"],
    ["アプリケーション", "ネットワーク", "IT"],
    ["脆弱性", "パスワード", "暗号"],
    ["複製権", "コピーライト", "版権"],
    ["権利", "財産権", "フェアユース"],
    ["文化庁", "海賊版", "プログラム"],
    ["SSL", "認証", "ポリシー"],
    ["ジャスラック", "音楽教室"]
]
}';

$array = json_decode($json, true); //連想配列に変換
$data_json = json_encode($array);  //json形式の文字列に変換
$url = 'http://localhost:8000/api/posttest';
postJson($url, $data_json);

?>
