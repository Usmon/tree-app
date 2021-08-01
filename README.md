# Tree application

This project of Tree (drag & drop, search, create, delete, update)

## Technical requirements
1. PHP 8
2. MySQL 5.6 / Recommended version 8x
3. Composer last version
4. GIT last version

## Installation guide
```git clone https://github.com/Usmon/tree-app.git``` <br>
```cd tree-app``` <br>
```composer install``` <br>
```cp .env.example .env``` <br>
```nano .env``` and set up your DB connections, APP_ENV = local || prod (prod - for production mode) and ```CTRL+X``` <br>
```php artisan key:generate``` <br>
```php artisan migrate``` <br>
```php artisan db:seed``` <br>
 
---

# 🐳 With Docker

## Clone project
```
git clone https://github.com/Usmon/tree-app.git
```
### Set environment variables
Just create .env file the same as .env.example with appropriate values
```
cd tree-app
```
```
cp .env.example .env
```
### Building docker image

```
docker-compose up --build
```


Happy coding... ☕️
