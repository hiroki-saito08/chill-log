## 起動方法

フロント側の簡易サーバー
npm run dev

アプリ側の簡易サーバー
php artisan serve

APP_URL: http://localhost:8000/

開発用コマンド
php artisan migrate:fresh --seed

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan clear-compiled
php artisan optimize:clear
composer dump-autoload

やることリスト
Bio の改行が反映されない
マックスの文字数の時に表示崩れするかも
名前変更の機能は必要
メアド確認の機能と、メアド変更も可能にしたい
投稿者のプロフィールに飛ぶプロセスがない
