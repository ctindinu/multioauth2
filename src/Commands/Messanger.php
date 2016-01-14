<?php namespace Viable\MultiOAuth2\Commands;



class Messanger {


  /**
   * forGrant
   * Will output a helper message to complete the grant registration.
   * @param mixed $grant
   * @param mixed $namespace
   * @param mixed $token_ttl
   * @access public
   * @return string
   */
  public function forGrant($grant, $namespace, $token_ttl) {


      $message  = "Grant $grant created!\n" ;
      $message .= "There are 3 more steps required to register the `$grant` grant: \n ";

      $message .= "1. Add this configuration to your oauth2 config file in the `grant_types` section";
      $message .="
        '" . strtolower($grant) . "' => [
          'class'            => '\\$namespace\\" . ucfirst(strtolower($grant)) . "\\Grant',
          'callback'         => '\\$namespace\\" . ucfirst(strtolower($grant)) . "\\Attempt@verify',
          'access_token_ttl' => $token_ttl ,
        ],
      \n";
      $message .= "2. Add this configuration to your auth config file in the `guards` section \n";

      $message .="
        '" . strtolower($grant)  . "' => [
          'driver' => 'session',
          'provider' => '" . strtolower($grant) . "',
        ],
        \n";

      $message .= "3. Add this configuration to your auth config file in the `providers`  section \n";

      $message .="
        '" . strtolower($grant)  . "' => [
          'driver' => 'eloquent',
          'model'  =>  << ENTER YOUR MODEL CLASS NAME >>,
        ],
        \n";

      return $message;
  }


}
