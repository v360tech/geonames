# geonames

A Laravel (php) package to interface with the geo-location services at geonames.org.

## Installation
```
composer require michaeldrennen/geonames
```
And then add `geonames` provider to `providers` array in `app.php` config file:

```php
V360Tech\Geonames\GeonamesServiceProvider::class,
```

After that, Run migrate command:

```
php artisan migrate
```

Want to install all of the geonames records for the US, Canada, and Mexico as well as pull in the feature codes 
definitions file in English? 
```php
php artisan geonames:install --country=US --country=CA --country=MX --language=en
```

Want to just install everything in the geonames database?
```php
php artisan geonames:install
```

## Maintenance
Now that you have the geonames database up and running on your system, you need to keep it up-to-date.

I have an update script that you need to schedule in Laravel to run every day.

Assuming your servers are running on GMT, your update command would look like: 
```php
$schedule->command('geonames:update')->dailyAt('3:00');
```

The update artisan command will handle the updates and deletes to the geonames table.

By default, `GeonamesServiceProvider` will run it for you daily at `config('geonames.update_daily_at')`. 

## Gotchas
Are you getting something like: 1071 Specified key was too long

@see https://laravel-news.com/laravel-5-4-key-too-long-error

Add this to your AppServiceProvider.php file:
```php
Schema::defaultStringLength(191);
```

## A quick word on indexes

This library contains a bunch of migrations that contain a bunch of indexes. Now not everyone will need all of the indexes.

So when you install this library, run the migrations and delete the indexes that you don't need.

Also, Laravel doesn't let you specify a key length for indexes on varchar columns. There are two indexes suffering from this limit. Instead of creating indexes on those columns the "Laravel way", I send a raw/manual query to create the indexes with the proper lengths.
