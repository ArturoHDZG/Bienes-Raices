<?php
// URL directions
require_once 'app.php';

// View templates
function includeTemplate(string $name, bool $home = false)
{
  include TEMPLATES_URL . "/{$name}.php";
}

// Login session
function loginOn() : bool
{

  session_start();
  $auth = $_SESSION['login'];

  if (!isset($_SESSION['login'])) {

    $_SESSION['login'] = '';

  }

  if ($auth) {

    return true;

  }

  return false;

}
