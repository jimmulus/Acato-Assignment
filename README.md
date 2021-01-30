<p align="center"><img src="https://fronteers.nl/_img/werkgevers/acato-logo.png" width="400"></p>

## Installation after clone

<p><strong>Open folder in your terminal</strong></p>

<p><strong>Run command in terminal to install packages from composer.json</strong><br>
composer install</p>

<p><strong>Run command in terminal to install packages from package.json</strong><br>
npm install</p>

<p><strong>Copy the .env.example file and rename it to .env</strong></p>

<p><strong>Run command in terminal to generate an APP_KEY</strong><br>
php artisan key:generate</p>

<p><strong>Run command in terminal to add JWT Secret in .env file</strong><br>
php artisan jwt:secret</p>

<p><strong>setup url</strong><br>
APP_URL</p>

<p><strong>Setup  database connection in your .env file</strong><br>
DB_DATABASE<br>
DB_USERNAME<br>
DB_PASSWORD

<p><strong>Setup mail in .env file</strong><br>
MAIL_MAILER=smtp<br>
MAIL_HOST<br>
MAIL_PORT<br>
MAIL_USERNAM<br>
MAIL_PASSWORD<br>
MAIL_FROM_ADDRESS<br>
MAIL_FROM_NAME</p>

<p><strong>Add app url to.env file for application use</strong><br>
MIX_APP_URL="${APP_URL}"</p>

<p><strong>Run command in terminal to migrate database</strong><br>
php artisan migrate</p>

<p><strong>Run command in terminal to run in development mode</strong><br>
npm run dev</p>

<p><strong>Run command in terminal to start server (or setup your own webserver)</strong><br>
php artisan serve</p>
