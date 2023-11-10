<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installing MongoDB database at PC

* [MongoDB Community Edition](https://www.mongodb.com/docs/manual/administration/install-community/) (MongoDB installation).
* [MongoDB Compass (GUI)](https://www.mongodb.com/try/download/compass) (Graphic interface).
* [MongoDB dependency Laravel](https://github.com/jenssegers/laravel-mongodb) (MongoDB package for installation on Laravel).

## After clone repository

1 - Run the following command to install dependencies of repository.
```
composer install
```

2 - Create `.env` file using the command:
```
cp .env.example .env
```

3 - Run the following command to generate `API_KEY` value of `.env` file.
```
php artisan key:generate
```

4.1 - Active MongoDB in your PC (I'm using distro Ubuntu of Linux, depending your operating system may be different) using the following command:
```
sudo systemctl start mongod
```

4.2 - Check if MongoDB is enabled.
```
sudo systemctl status mongod
```

4.3 - Case you want to disable.
```
sudo systemctl stop mongod
```

5 - When executing the migrations, is necessary use the commands to create some populated tables to some selection fields at forms.

```
php artisan migrate --seed
```

Or using the commands:
```
php artisan migrate
php artisan db:seed
```

6 - Execute Apache server
```
php artisan serve
```

## Setting MongoDB database in Laravel project to the first time

1 - Create a Laravel project with compatible version to MongoDB database. Please, verify if your version Laravel application is compatible [here](https://github.com/jenssegers/laravel-mongodb).
```
composer create-project --prefer-dist laravel/laravel:^x.x name-project
```

2 - Install mongodb dependecy.
```
composer require jenssegers/mongodb
```

3 - Add the following line in `config/app.php`.
```
'providers' => [
    ...
    Jenssegers\Mongodb\MongodbServiceProvider::class,
],
```

4 - Add and replace the following lines in `config/database.php`.

4.1 - Replace:
```
'default' => env('DB_CONNECTION', 'mysql'),
```

4.2 - To:
```
'default' => env('DB_CONNECTION', 'mongodb'),
```

4.3 - On same file add `mongodb` settings:
```
'connections' => [
    ...
    'mongodb' => [
        'driver' => 'mongodb',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', 27017),
        'database' => env('DB_DATABASE', 'homestead'),
        'username' => env('DB_USERNAME', 'homestead'),
        'password' => env('DB_PASSWORD', 'secret'),
        'options' => [
            'appname' => 'homestead',
        ],
    ],

 ],
```

5 - Change the following informations in `.env`.
```
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=laravel-mongodb
DB_USERNAME=
DB_PASSWORD=
```

## Hunters
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/hunter.png?raw=true)

## Rewards
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/reward.png?raw=true)

## Rewarded
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/rewarded.png?raw=true)

## MongoDB Compass (Hunters table)
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/mongodb_compass1.png?raw=true)

## MongoDB Compass (Rewards table)
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/mongodb_compass2.png?raw=true)

## MongoDB Compass (Rewarded table)
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/mongodb_compass3.png?raw=true)

## Export and import database (on my Linux distro)

1 - Open the terminal and execute the following command to active MongoDB:
```
sudo systemctl start mongod
```
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/1.png?raw=true)

2 - Check if the MongoDB is working execute the following command.
```
sudo systemctl status mongod
```
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/2.png?raw=true)

3 - It will be like this.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/3.png?raw=true)

4 - Open the MongoDB Compass and click on `connect`.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/4.png?raw=true)

5 - Open your database defined to you (in my case `laravel-mongodb`).
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/5.png?raw=true)

6 - Verify existing collections.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/6.png?raw=true)

7 - Go to `home` page
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/7.png?raw=true)

8 - Open the terminal and execute the following command to export `laravel-mongodb` database (Verify the name of your database):
```
mongodump --db laravel-mongodb
```
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/8.png?raw=true)

9 - All collections of database (in my case `laravel-mongodb`) were exported.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/9.png?raw=true)

10 - Back to `home` page and you will notice the existence of `dump` paste.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/10.png?raw=true)

11 - Click on paste of your database (in my case `laravel-mongodb`).
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/11.png?raw=true)

12 - All collections of database (in my case `laravel-mongodb`) are saved in `JSON` and `BSON` files.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/12.png?raw=true)

13 - Back to MongoDB Compass and delete your database clicking on `trash` icon.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/13.png?raw=true)

14 - Confirm the exclusition writing database name (in my case `laravel-mongodb`).
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/14.png?raw=true)

15 - The database was deleted (in my case `laravel-mongodb`).
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/15.png?raw=true)

16 - Open the terminal using the path of database export (in my case `laravel-mongodb`) paste existing in `dump` paste.
```
cd ~/dump/laravel-mongodb
```

Then you will have to insert the following command (Verify the name of database that you want to import, in my case `laravel-mongodb`):
```
mongostore --db laravel-mongodb .
```

![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/16.png?raw=true)

17 - The database was imported to MongoDB Compass.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/17.png?raw=true)

18 - Return to MongoDB Compass and `refresh` the database.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/18.png?raw=true)

19 - Your database (in my case `laravel-mongodb`) returned.
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/19.png?raw=true)

20 - Return to terminal and write the following command to desactive MongoDB.
```
sudo systemctl stop mongod
```
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/20.png?raw=true)

21 - Check if MongoDB was desactived.
```
sudo systemctl status mongod
```
![](https://github.com/Iury189/laravel-mongodb/blob/master/public/imagens/21.png?raw=true)
