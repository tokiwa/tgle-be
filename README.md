# TGLE Back End

## 概要

フロントエンド(tgle-fe)からのRequestに応じて、様々な処理を行いその結果をフロントエンドにResponseするREST APIを実装しています。グループ形成は教員および学生のキーワードをグループ形成サービスのREST APIにPOSTし、そのResponseをデータベースに記録するとともに、グループ構成を教員および学生に提示するために必要なデータをJSON形式でフロントエンドに返します。実装はPHPとLaravelフレームワークを用い、データベースはリレーショナルデータベースのMySQLを用いています。


## 実行環境

TGLE Back End の実行は、開発を行なうローカルPCでWebサーバを稼働させる方法と、AWSのようなクラウドでサーバを稼働させる方法があります。いずれの方法でもPHP 7.3 以上が必要となりますが、XAMPPを利用することが最も簡便です。下記のパッケージでの稼働を確認しています。

**ローカルPC**
- Windows 10 + xampp-windows-x64-7.4.21
    - PHP 7.4.21
    - Apache 2.4.48
    - MariaDB 10.4.20
    - Perl 5.32.1
    - OpenSSL 1.1.1k (UNIX only)
    - phpMyAdmin 5.1.1

- XAMPP 設定

Front EndとBack Endは一つのXAMPPで稼働させています。具体的にはFront EndはSSL環境で稼働させるため、D:\xampp1\apache\conf\extra\httpd-ssl.confにてDocumentRootを設定し、Back EndはD:\xampp1\apache\conf\httpd.confにてDocumentRootを設定しています。Back EndとFront End間は単なるHTTPでポートを8000としています。

- DocumentRootの設定
  
    xampp/apache/conf/extra/httpd.conf にて設定します。

```
Listen 8000
<VirtualHost *:8000>
DocumentRoot "D:/tgle/be/public"
<Directory "D:/tgle/be/public">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>
</VirtualHost>  
```

## Database

データベースのテーブル構成は app ディレクトリにある次のファイルを参照してください。
- Group.php
- Keyword.php
- Lesson.php