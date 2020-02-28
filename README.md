# Starlight.io - 1

### Requirements:
- php ^7.4
- composer

### Installation
-   `git clone https://github.com/13dev/starlight.io-task1.git`
-   `cd starlight.io-task1`
-   `composer install`
-   `cp .env.example .env` (if file not exists)
-   `php artisan key:generate`
-   Configure database host, user, password in `.env` file;
-   `php artisan migrate`
-   `php artisan db:seed` (to create dummy data)

### API endpoints 
`note:` commercials stands for ads.

|METHOD|ENDPOINT|PARAMS|BODYPARAMS| 
|:-----:|:------|:-----|:---------|
|GET    |`/commercials`			| `sortBy=(created_at or price)`,<br>`order=(asc or desc)` 												||
|GET  	| `/commercials/{id}`  	| `include=description,photos` (the include param receive fields to include separated by `,`) 		||
|POST	| `/commercials/`  		| No GET params  																					| `title`, `description`, `price`, `photos` (array) |


#### API endpoints examples
- `/commercials?sortBy=created_at&order=desc`
- `/commercials/3?include=photos`
- `/commercials/3?include=description,photos`

### Docker Instalation (Optional)
- Run `docker-compose up -d`
- Don't forget to configure `.env` file with ip of lumen-mysql container.
