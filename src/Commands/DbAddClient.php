<?php namespace Viable\MultiOAuth2\Commands;

use Illuminate\Console\Command;
use Exception;
use DB;

class DbAddClient extends Command {

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'mo2:db:addClient {id} {secret} {client}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Adds a new oauth2 client to the database';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle() {

    $id     = $this->argument('id');
    $secret = $this->argument('secret');
    $client = $this->argument('client');

    try{
      DB::table("oauth_clients")->insert([
        'id'     => $id,
        'secret' => $secret,
        'name'   => $client
      ]);

      $this->info("Client $client added to db.");
    } catch(Exception $e) {
      $this->error("Something went wrong. $e");
    }
  }

}
