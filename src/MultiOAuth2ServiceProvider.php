<?php namespace Viable\MultiOAuth2;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider;
use LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;

class MultiOAuth2ServiceProvider extends ServiceProvider {

  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot() {

    if (! $this->app->routesAreCached()) require __DIR__ . "/../routes.php";

    $this->setupConfig();
    $this->registerCommands();

  }

  /**
   * Register any package services.
   *
   * @return void
   */
  public function register() {


    $this->app->register(FluentStorageServiceProvider::class);
    $this->app->register(OAuth2ServerServiceProvider::class);
    $this->app->register(CorsServiceProvider::class);

    $loader = AliasLoader::getInstance();
    $loader->alias('Authorizer', \LucaDegasperi\OAuth2Server\Facades\Authorizer::class);
  }

  protected function setupConfig() {
    $cors        = realpath(app_path() . '/../vendor/barryvdh/laravel-cors/config/cors.php');
    $oauth2      = realpath(app_path() . '/../vendor/lucadegasperi/oauth2-server-laravel/config/oauth2.php');
    $multioauth2 = realpath(__DIR__.'/../config/multioauth2.php');

    $this->publishes([
      $cors        => config_path('cors.php'),
      $oauth2      => config_path('oauth2.php'),
      $multioauth2 => config_path('multiouath2.php')
    ]);

    $this->mergeConfigFrom($cors, 'cors');
    $this->mergeConfigFrom($oauth2, 'oauth2');
    $this->mergeConfigFrom($multioauth2, 'multioauth2');

  }


  protected function registerCommands(){
    $this->commands([
      \Viable\MultiOAuth2\Commands\MakeGrant::class,
      \Viable\MultiOAuth2\Commands\DbSetup::class,
      \Viable\MultiOAuth2\Commands\DbAddClient::class,
      \Viable\MultiOAuth2\Commands\DbAddScope::class,
    ]);
  }

}
