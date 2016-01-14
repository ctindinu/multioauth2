<?php namespace {{NSPACE}}\{{CLASSNAME}};

use Auth;

class Attempt {

  public function verify($email, $password) {

    $creds = [
      'email'    => $email,
      'password' => $password
    ];

    return (Auth::guard("{{GRANT}}")->attempt($creds)) ?   Auth::guard("{{GRANT}}")->user()->id : false;
  }

}
