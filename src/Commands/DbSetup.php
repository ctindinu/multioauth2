<?php namespace Viable\MultiOAuth2\Commands;

use Illuminate\Console\Command;
use Exception;

class DbSetup extends Command {

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'mo2:db:init';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Initializes the oauth2 migrations';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle() {

    try{
      $this->callSilent("vendor:publish" , [
        '--provider' => 'LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider',
        '--tag'      => ['migrations']
      ]);

      $this->callSilent("migrate");

      $this->info("Oauth2 migrations added to db");
    } catch(Exception $e) {
      $this->error("Something went wrong. $e");
    }
  }

}
