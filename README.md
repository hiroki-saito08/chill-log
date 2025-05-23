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
・レスポンシブ対応必須！！
・マイポストとお気に入りポストの一覧をページネーションする必要がある
・マックスの文字数の時に表示崩れするかも
・Bio の改行が反映されない
・編集の map から選択を非表示
・投稿詳細から一覧に戻ったり次の投稿に移動するリンクが UI 的に欲しい
・名前変更の機能は必要
・メアド確認の機能と、メアド変更も可能にしたい
・画像の複数投稿欲しい
・投稿者のプロフィールに飛ぶプロセスがない
・Recommended Visit Time はラジオで複数選択の方がいい
・カテゴリーは選べるけど、自由にもつけれるようにしよう
