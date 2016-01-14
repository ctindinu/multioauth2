<?php namespace Viable\MultiOAuth2\Commands;

use Viable\MultiOAuth2\Exceptions\GrantExistsException;


class Builder {

  /**
   * tpl
   * filepath to the the template file
   * @var string
   * @access public
   */
  public  $tpl;
  /**
   * replacement
   * array of replacements in the tempate file
   * @var array
   * @access public
   */
  public  $replacement;
  /**
   * location
   * folder path with the root in the app folder where the grants will be generated
   * @var string
   * @access public
   */
  public  $location;


  /**
   * makeGrant
   *
   * primary method of the this class. Will generate both required files for the new grant.
   * @param mixed $location
   * @param mixed $name
   * @param mixed $replacement
   * @access public
   * @return void
   */
  public function makeGrant($location, $name, $replacement) {

    $this->name        = ucfirst(strtolower($name));
    $this->replacement = $replacement;
    $this->location    = $location;


    if(file_exists(app_path() . "/$this->location/$this->name"))  throw new GrantExistsException($this->name);


    mkdir(app_path("/$this->location/$this->name"), 0777, true);

    $this->makeFile("Grant.tpl"  , "Grant");
    $this->makeFile("Attempt.tpl", "Attempt");

  }


  /**
   * makeFile
   * will combine the boilerplate fie with the replacement array
   * @param mixed $tpl
   * @param mixed $type
   * @access private
   * @return void
   */
  private function makeFile($tpl, $type) {

    $this->tpl = file_get_contents(__DIR__ .  "/../templates/$tpl");

    foreach($this->replacement as $what => $with) {
      $this->tpl = str_replace( "{{".strtoupper($what) . "}}", $with, $this->tpl);
    }

    $this->save($type);

  }

  /**
   * save
   * will write the file to disk
   * @param mixed $type
   * @access private
   * @return void
   */
  private function save($type) {
    $path = app_path() . "/" . str_replace("\\", "/" , $this->location);
    file_put_contents("$path/$this->name/$type.php", $this->tpl);

    $this->tpl = null;

  }

}
