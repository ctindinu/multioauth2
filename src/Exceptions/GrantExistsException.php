<?php namespace Viable\MultiOAuth2\Exceptions;

use \Exception;

class GrantExistsException extends Exception {


  public function __construct($name) {
    $this->message = "Grant with name `$name` already exists!... Aborting!";
  }

}
