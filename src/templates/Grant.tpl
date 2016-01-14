<?php namespace {{NSPACE}}\{{CLASSNAME}};

use League\OAuth2\Server\Grant\PasswordGrant;

/**
 * Password grant class
 */

class Grant extends PasswordGrant {

    /**
     * Grant identifier
     *
     * @var string
     */

    protected $identifier = '{{GRANT}}';

}

