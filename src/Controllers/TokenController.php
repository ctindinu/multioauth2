<?php namespace Viable\MultiOAuth2\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Authorizer;
use Exception;

class TokenController extends BaseController {


  /**
   * generateToken
   * Generate a new access_token and a new refresh_token.
   * @access public
   * @return response
   */

  public function generateToken() {
    try{
      $token = Authorizer::issueAccessToken();
      $token['access_token']  = "Bearer " . $token['access_token'];

    }catch (Exception $e) {
      return response($e->getMessage(), 403);
    }


    return response(array_only($token, ['access_token', 'refresh_token']));
  }

}
