## Laravel Passport Socialize

Create new project

    composer create-project --prefer-dist laravel/laravel laravel-passport-socialize
  
Run project

    php artisan serve
    
Create migration script

    php artisan make:migration create_products_table --create=products
    php artisan make:migration add_product_image_to_products_table --table=products

Scaffolding auth

    php artisan make:auth
    
Link storage to public folder

    php artisan storage:link
    
Install passport     

    composer require laravel/passport
    php artisan migrate
    php artisan passport:install

Enable CORS 

    php artisan make:middleware Cors
    
    Kernel.php
    protected $middleware = [
        ...
        \App\Http\Middleware\Cors::class,
    ];

Install swagger

    php composer require "darkaonline/l5-swagger:5.6.*"
    php artisan l5-swagger:generate
    set L5_SWAGGER_GENERATE_ALWAYS to true in your .env file for auto-generated

Install voyager (scaffolding admin)

     composer require tcg/voyager
     php artisan voyager:install --with-dummy
    
### Tips

MySQL <= 5.6 problem

    AppServiceProvider.php
    function boot()
    {
        Schema::defaultStringLength(191);
    }


### Reference:

- [Laravel Official Documentation](https://laravel.com/docs)
- [Getting started with Laravel Passport](https://scotch.io/@neo/getting-started-with-laravel-passport)
- [DarkaOnLine/L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
- [Laravel Social Authentication with Socialite](https://scotch.io/tutorials/laravel-social-authentication-with-socialite)
- [Voyager](https://laravelvoyager.com/)
