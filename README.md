# geonames

A Laravel (php) package to interface with the geo-location services at geonames.org.

## Installation
```
composer require v360tech/geonames
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