<?php
class Person {
  // Properties
  public $name;
  public $email;

  function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  function validatePerson() {
    return !empty($this->name) and !empty($this->email) and $this->isValidEmail();
  }

  function isValidEmail() {
    $pattern = "/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/";
    return preg_match($pattern, $this->email);
  }

}
?>