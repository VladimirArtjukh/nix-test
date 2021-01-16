## Instructions

- Clone repository
- Install packages: `php composer update`
- Create DB
- Based on the file `.env.example`, create the file` .env`, for this, run the command `cp .env.example .env`, then generate the keys using the command` php artisan key: generate`
- Write the database settings in `.env`
- Install DB table and generate seeders: `php artisan migrate --seed`
- Install npm  `npm install`.
- Run command `npm run production`