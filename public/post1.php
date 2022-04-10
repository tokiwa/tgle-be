<?php
/**
 * @param string $url 送信先のURL
 * @param string $data json形式のデータ
 * @return string リクエストのレスポンス
 */
function postJson($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
}

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

$array = json_decode($json, true);
echo $array["groupKeyword"][0]."<br>";
echo $array["groupKeyword"][1]."<br>";
echo $array["groupKeyword"][2]."<br>";
echo $array["student"][0][0]."<br>";
echo $array["student"][0][1]."<br>";

$url = 'http://localhost:8000/api/posttest';

postJson($url, $array);

?>
