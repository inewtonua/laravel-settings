# Laravel localized settings storage
 * Simple key-value storage
 * Support multi-level array (dot delimited keys) structure.
 * Localization supported.
 
## Installation

1. Install package

    ```bash
    composer require ineatonua/laravel-settings
    ```

1. Edit config/app.php (Skip this step if you are using laravel 5.5+)

    service provider:

    ```php
    Ineatonua\Setting\SettingServiceProvider::class,
    ```

    class aliases:

    ```php
    'Setting' => Ineatonua\Setting\SettingFacade::class,
    ```

1. Create settings table

    ```bash
    php artisan vendor:publish --tag=laravel-settings
    php artisan migrate
    ```

## Usage

```php
Setting::get('name', 'Computer');
// get setting value with key 'name'
// return 'Computer' if the key does not exists

Setting::all();
// get all settings

Setting::lang('zh-TW')->get('name', 'Computer');
// get setting value with key and language

Setting::set('name', 'Computer');
// set setting value by key

Setting::lang('zh-TW')->set('name', 'Computer');
// set setting value by key and language

Setting::has('name');
// check the key exists, return boolean

Setting::lang('zh-TW')->has('name');
// check the key exists by language, return boolean

Setting::forget('name');
// delete the setting by key

Setting::lang('zh-TW')->forget('name');
// delete the setting by key and language
```

## Dealing with array

```php
Setting::get('item');
// return null;

Setting::set('item', ['USB' => '8G', 'RAM' => '4G']);
Setting::get('item');
// return array(
//     'USB' => '8G',
//     'RAM' => '4G',
// );

Setting::get('item.USB');
// return '8G';
```

## Dealing with locale

By default language parameter are being resets every set or get calls. You could disable that and set your own long term language parameter forever using any route service provider or other method.

```php
Setting::lang(App::getLocale())->langResetting(false);
```