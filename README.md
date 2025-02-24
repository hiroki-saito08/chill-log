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
composer dump-autoload

ID: test@test.com
PASS: password

やることリスト
・サーバーサイドのバリデーションエラーの時に内容を表示したい
・投稿するボタンを押してからローディング画面を表示したい

済み
・コメントはログインユーザーに紐づけて、1 投稿に 1 回のユニーク -> 投稿済みの場合は編集可能に変更
・コメントに削除機能
・投稿者に修正機能を追加
・投稿者に削除機能を追加
・写真は複数設定できてスライドショーにしたい。選んで拡大できるような → 一旦は 1 つの投稿に 1 つで作成
・投稿、コメントにユーザーの名前を表示する
・プロフィール画面の修正画面を作る
・写真サイズを調整する
・検索機能を実装する
・投稿の修正時に画像の削除ができない
・コメントと投稿一覧をページネーションにする
・プロフィール画面に自分の投稿履歴を追加する
・お気に入り機能を実装する
・投稿時に位置情報を選択可能にする
・下書き機能を作る
・各フォームにバリデーションをつける
・投稿の内容に改行が反映されない
・画像のアップロード時に画像サイズを軽くできないか
