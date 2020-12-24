<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel Toko Online

Laravel Toko Online adalah materi pembelajaran dari https://belajarphp.net

- [php artisan make:auth](membuat ui login dan register dengan mudah dilaravel)
- [composer require realrashid/sweet-alert](https://realrashid.github.io/sweet-alert/install)

- If using laravel < 5.5 include the service provider and alias within config/app.php.

    'providers' => [
        RealRashid\SweetAlert\SweetAlertServiceProvider::class,
    ];

    'aliases' => [
        'Alert' => RealRashid\SweetAlert\Facades\Alert::class,
    ];

- configuration:
    Include 'sweetalert::alert' in master layout

        @include('sweetalert::alert')
-run comand :
        [php artisan sweetalert:publish]
- Using the Facade
    First import the SweetAlert facade in your controller.

    use RealRashid\SweetAlert\Facades\Alert;
