# お問い合わせフォーム
## 環境構築
Dockerビルド
1. git clone リンク
2. docker-compose up -d -build
   
＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから、envを作成し、環境変数を変更 (下記に変更)

   【.envファイル】

   DB_HOST=mysql
   
   DB_DATABASE=laravel_db
   
   DB_USERNAME=laravel_user
   
   DB_PASSWORD=laravel_pass
   
4. php artisan key:generate
   
※MySQL、laravel_userに権限を与えるために下記を実行
1. docker-compose exec mysql bash
2. mysql -u root -p 　※パスワードは、doker-compose.ymlに記載
　-- まずユーザーを作成
　　CREATE USER 'laravel_user'@'%' IDENTIFIED BY 'laravel_pass';

　-- ユーザーに権限を付与
　　GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'%';

　-- 権限を反映
　　FLUSH PRIVILEGES;
9. 
10. php artisan migrate
11. php artisan db:seed
   
## 使用技術
• PHP 8.2.8

• Laravel 10.0

• MySQL 8.0

## URL

・開発環境：http://localhost/

• phpMyAdmin : http://localhost:8080/


![test-01 drawio](https://github.com/user-attachments/assets/d9e6b510-5bef-4857-a5cb-4f6bea582c16)
