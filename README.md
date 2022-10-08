
## About Project

This project is the main project, whick contains the articles pages and the editor js plugin

## Running Project
These are the commands you should execute one by one to run the project:
- git init
- git clone https://github.com/samar147hallak/newsifier-laravel.git
- composer install
- create an empty database on MySQL
- copy the .env.example to .env file and set the database connection settings
- php artisan migrate
- php artisan key:generate
- php artisan serve  

### Open another command prompt and go to the project folder, then run these 2 commands:
- npm install
- npm run dev

### Open a third command prompt fo the following:
- cd newsifier-nodejs
- npm install
- npm run dev

### Then make sure that the node project is running and open you browser and go to http://localhost:8000/ 

### Notes about the project
- This Repo represents a polished MVP of a news CMS where clients can create articles with GIF images.
- The system has an authentication system. The user is log in, log out and sign up (Laravel) (ps: this is a basic system so admin panel is not implemented at this stage, article creation is done from a specific screen for registered user)
- The search GIF’s API is implemented with NodeJS, the API provider can be easily changed in only one place (settings file)
- to enhance the performance of the search plugin lazy loadiing is implemented, only 20 GIFs are fetched at a time;
- Eloquent Sluggable is used to ensure the uniqueness of the slugs among the articles.
