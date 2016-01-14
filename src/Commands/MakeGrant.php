<?php namespace Viable\MultiOAuth2\Commands;

use Illuminate\Console\Command;

class MakeGrant extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mo2:grant {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Grant for oauth2';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $builder;

    public function __construct(Builder $builder, Messanger $messanger) {

        parent::__construct();
        $this->builder   = $builder;
        $this->messanger = $messanger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

      $location  = config("multioauth2.location");
      $namespace = config("multioauth2.namespace");
      $grant     = $this->argument('name');
      $token_ttl = config("multioauth2.access_token_ttl");

      $replacement = [
        "NSPACE"     => $namespace,
        "GRANT"      => strtolower($grant),
        "CLASSNAME"  => ucfirst(strtolower($grant))
      ];

      $this->builder->makeGrant($location, $grant, $replacement);

      $message = $this->messanger->forGrant($grant, $namespace, $token_ttl);

      $this->info($message);

    }

}
