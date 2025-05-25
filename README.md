# Chill-log

Chill-log is a social web application for discovering and sharing relaxing places such as scenic spots, quiet cafes, and hidden retreats.  
It is built as a full-stack single-page application using Laravel 9, Vue 3, and Inertia.js, with a responsive and modern Bootstrap-based UI optimized for both mobile and desktop.

## Features

-   Post creation with title, category, description, recommended visit time, and image upload
-   Upload and preview images (currently supports one image per post)
-   Search posts by keyword or category, with sort options (newest/oldest)
-   User profile page with editable name, bio, and profile image
-   Favorite feature to bookmark and view saved posts in MyPage
-   One-time review submission per post with 4-category ratings and a comment
-   User authentication (login, registration) using Laravel Breeze
-   Email verification system on account creation
-   NG word filter (supports both English and Japanese)
-   Fully responsive layout with Bootstrap 5
-   Seeders available for users, posts, images, reviews, and favorites

## Tech Stack

-   Backend: Laravel 9 (PHP)
-   Frontend: Vue 3 with Inertia.js
-   UI: Bootstrap 5 (with scoped custom CSS)
-   Database: MySQL (Amazon RDS compatible)
-   Authentication: Laravel Breeze
-   File Storage: Laravel filesystem (public disk)
-   Mail: SMTP (configurable for production with Xserver)

## Local Development Setup

```bash
git clone https://github.com/yourusername/chill-log.git
cd chill-log

# Install dependencies
composer install
npm install && npm run dev

# Environment setup
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Link storage
php artisan storage:link

# Start server
php artisan serve

# Clearing the cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan clear-compiled
php artisan optimize:clear
composer dump-autoload
```
