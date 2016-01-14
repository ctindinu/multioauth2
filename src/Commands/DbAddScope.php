<?php namespace Viable\MultiOAuth2\Commands;

use Illuminate\Console\Command;
use Exception;
use DB;

class DbAddScope extends Command {

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'mo2:db:addScope {scope} {description?} ';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Adds a new oauth2 scope to the database';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle() {

    $scope       = $this->argument('scope');
    $description = !is_null($this->argument('description')) ?: '';

    try{
      DB::table("oauth_scopes")->insert([
        'id'   => $scope,
        'description' => $description
      ]);
      $this->info("Scope $scope added to db.");

    } catch(Exception $e) {

      $this->error("Something went wrong. $e");
    }
  }

}
