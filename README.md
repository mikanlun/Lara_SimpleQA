# Lara_SimpleQA

シンプルなQ & A（Laravelフレームワーク）

## Description

どなたでも、自由に質問と回答を投稿できます。  

***SAMPLE:***

![スクリーンショット 2021-01-14 17 35 01](https://user-images.githubusercontent.com/36429862/104673553-4fd99c80-5725-11eb-99f2-5a295e42b635.png)

![スクリーンショット 2021-01-14 17 33 37](https://user-images.githubusercontent.com/36429862/104673708-a7780800-5725-11eb-9582-8fadebf8f07c.png)

## Features

・質問一覧及び質問の投稿  
・質問に対する回答一覧、回答の投稿及び回答数の表示  
・ベストアンサーを選ぶことができる  
・ユーザーのアイコンを設定できる  
　未設定時のアイコン：  
 
## Requirement

・CentOS 7.4  
・PHP 7.2  
・mysql 5.7  
・Laravel 6.19  
・slick 1.8  
・bootstrap 4.0  

## Usage

1.質問の処理  
　・質問の登録（質問するボタン）（認証済みの時）  
　・質問の編集（新たに質問を投稿することする）  
　・質問の削除（削除ボタン）（認証済みの時）  
2.回答の処理  
　・回答の登録（回答するボタン）（認証済みの時）  
　・回答の編集（新たに回答を投稿することする）  
　・回答の削除（削除ボタン）（認証済みの時）  
3.ベストアンサーの処理  
　・ベストアンサーの選択（ベストアンサーボタン）（認証済みの時）  
4.アカウント  
　・ログイン（メニューバーより）  
　・ログアウト（メニューバーのユーザー名のプルダウンメニューより）（認証済みの時）  
　・ユーザーの新規登録（メニューバーより）  
　・ユーザーの編集、退会(削除)  
   （メニューバーのユーザー名のプルダウンメニューのアカウントより）（認証済みの時）  

## Settings

　1.env ファイルの設定  
 
    ・ 適宜、ご変更をお願いします。  

　2.PERMISSIONS  
 
    ・ strageとbootstrap/cacheディレクトリにread, write 権限を設定してください。

　3.テーブルの作成  
 
    ・ マイグレートをおこなってください。

　４.シンボリックリンク  
 
    ・ public/storageからstorage/app/publicへシンボリックリンクを張ってください。
    
     php artisan storage:link
  　

## Author

@mikanlun

## License

[MIT](https://github.com/mikanlun/MyGallery/blob/master/LICENSE)
