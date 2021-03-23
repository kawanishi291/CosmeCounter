# CosmeCounter
# 構成図
```
root/
　├ htdocs/
　│  ├ calendar/
　│  │   ├ config.php
　│  │   └ index.php
　│  ├ CSS/
　│  │   ├ login.css
　│  │   ├ master.css
　│  │   ├ pouch.css
　│  │   ├ sns.css
　│  │   └ style.css
　│  ├ dbconnect/
　│  │   ├ mysqli_connect.php.php
　│  │   └ pdo_connect.php
　│  ├ edit/
　│  │   ├ brand.php
　│  │   ├ brandup.php
　│  │   ├ item.php
　│  │   └ itemup.php
　│  ├ image/
　│  ├ img-upload/
　│  │   ├ img/
　│  │   │   └ update.php
　│  │   ├ img-upload.php
　│  │   └ next.php
　│  ├ JavaScript/
　│  │   ├ cal.js
　│  │   ├ jquery-3.3.1.min.js
　│  │   ├ memo.js
　│  │   ├ slideshow01.js
　│  │   ├ slideshow02.js
　│  │   └ sticky-sidebar.js
　│  ├ pouch/
　│  │   ├ img/
　│  │   ├ check.php
　│  │   ├ delete.php
　│  │   ├ edit.php
　│  │   ├ editup.php
　│  │   ├ index.php
　│  │   ├ pouch.php
　│  │   ├ result.php
　│  │   ├ select.php
　│  │   └ update.php
　│  ├ register_func-master/
　│  │   ├ core/
　│  │   │   ├ function/
　│  │   │   │   ├ message.php
　│  │   │   │   └ user.php
　│  │   │   ├ pages/
　│  │   │   │   ├ new_conversation.php
　│  │   │   │   └ view_conversation.php
　│  │   │   └ config.php
　│  │   ├ dbconnect.php
　│  │   ├ home.php
　│  │   ├ index.php
　│  │   ├ logout.php
　│  │   ├ register.php
　│  │   └ send.php
　│  ├ sns/
　│  │   ├ ajaxindex.php
　│  │   ├ ajaxsns.php
　│  │   ├ index.php
　│  │   ├ request.php
　│  │   └ sns.php
　│  ├ transaction/
　│  │   ├ flag_2.php
　│  │   ├ flag_3.php
　│  │   └ flag_4.php
　│  ├ trashbox/
　│  │   ├ dispose.php
　│  │   ├ index.php
　│  │   └ select.php
　│  ├ index.php
　│  └ profile.php
　├ php/
　│  ├ Dockerfile
　│  └ php.ini
　├ mysql/
　│  ├ db/
　│  │  └ init.sql
　│  └ my.cnf
　└ docker-compose.yml
```

# 環境構築手順
## 作成

#### Dockerイメージを立てる　=> imageをpullしてきて作成
```
$ docker-compose build
```

#### 立てたコンテナを起動　=> imageからコンテナを立て、起動
```
$ docker-compose up -d
```

#### 起動中のコンテナの詳細を確認
```
$ docker ps -a
```
#### mysqlのコンテナIDをコピーし、下記３ファイルを書き換える。

* /CosmeCounter/htdocs/dbconnect/mysqli_connect.php
* /CosmeCounter/htdocs/dbconnect/pdo_connect.php
* /CosmeCounter/htdocs/register_func-master/core/config.php

#### 確認
* [サイト画面](http://localhost)
* [DB画面](http://localhost:8080)

## 削除

#### データベースも含めてコンテナを削除
```
$ docker-compose down --volumes
```
#### 立てたコンテナの再起動　=> DockerイメージをビルドしたあとにDockerFileを変更したりした場合は再びビルドする必要がある
```
$ docker-compose up -d --build
```
