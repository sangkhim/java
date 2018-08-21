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
    
### Install passport     

    composer require laravel/passport
    php artisan migrate
    php artisan passport:install
    
config/app.php
    
    'providers' => [
        ...
        Laravel\Passport\PassportServiceProvider::class,
    ],
    
User.php
    
    class User extends Authenticatable
    {
        use HasApiTokens, Notifiable;
    }
    
AuthServiceProvider.php
    
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
    
config/auth.php
    
    'guards' => [
    ...
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

Enable CORS 

    php artisan make:middleware Cors
    
Kernel.php

    protected $middleware = [
        ...
        \App\Http\Middleware\Cors::class,
    ];

### Install swagger

    composer require "darkaonline/l5-swagger:5.6.*"
    php artisan l5-swagger:generate
    
.env

    L5_SWAGGER_GENERATE_ALWAYS=true
    
config/app.php
    
    'providers' => [
        ...
        L5Swagger\L5SwaggerServiceProvider::class,
    ],

### Install socialize     

    composer require laravel/socialite
    
config/app.php

    'providers' => [
        ...
        Laravel\Socialite\SocialiteServiceProvider::class,
    ],
    ...
    'aliases' => [
        ...
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
    ],
    
config/services.php

    'facebook' => [
        'client_id'     => env('FACEBOOK_ID'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect'      => env('FACEBOOK_URL'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_URL'),
    ],
    
.env

    FACEBOOK_ID=301141227295025
    FACEBOOK_SECRET=9fbaa617929b84d8b893c986ba606dd3
    FACEBOOK_URL=http://localhost:8000/auth/facebook/callback
    
    GOOGLE_ID=498337084148-d31817o0s761nnsgi72lphkmhtcdgpsd.apps.googleusercontent.com
    GOOGLE_SECRET=O7ej19VroDleLLVWja7DTMP5
    GOOGLE_URL=http://localhost:8000/auth/google/callback
    
web.php
    
    Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
    
api.php

    Route::post('users/login', 'UserRestController@loginUser');    

### Install voyager (scaffolding admin)

     composer require tcg/voyager
     php artisan voyager:install --with-dummy
    
### MySQL < 5.7 problem

AppServiceProvider.php

    function boot()
    {
        Schema::defaultStringLength(191);
    }


### References:

- [Laravel Official Documentation](https://laravel.com/docs)
- [Getting started with Laravel Passport](https://scotch.io/@neo/getting-started-with-laravel-passport)
- [DarkaOnLine/L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
- [Laravel Social Authentication with Socialite](https://scotch.io/tutorials/laravel-social-authentication-with-socialite)
- [Voyager](https://laravelvoyager.com/)
