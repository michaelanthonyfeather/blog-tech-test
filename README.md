
# Blog Tech Test

This Laravel application allows users to create, list, search, and like posts.

# Features
- User creates a new post with title and content.
- Posts are displayed in a list with title and like functionality.
- Search functionality allows filtering posts by title using Ajax.
- Users can like/unlike posts (requires login).


# Setup guide

Clone the repository

    git clone git@github.com:michaelanthonyfeather/blog-tech-test.git

Switch to the repo folder

    cd blog-tech-test

Install all the dependencies using composer

    composer install

Install all the dependencies using npm

    npm install


Start the local development server. This will start the server at `http://localhost:8000`

    php artisan serve


Start the local node server

    npm run watch

# Database setup

Laravel 11 now comes with SQlite database by default. You can change the database configuration in the `.env` file to use MySQL or any other database. View instructions [here](https://laravel.com/docs/11.x/installation#databases-and-migrations).


Run migrations

    php artisan migrate

If you want to seed the database with dummy post data, run

    php artisan db:seed

