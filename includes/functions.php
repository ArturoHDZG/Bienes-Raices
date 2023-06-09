<?php

declare(strict_types=1);

// URL directions
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('FOLDER_IMAGES', __DIR__ . '/../images/');

// View templates
function includeTemplate(string $name, bool $home = false)
{
  require_once TEMPLATES_URL . "/{$name}.php";
}

// Login session
function login()
{
  session_start();

  if (!isset($_SESSION['login'])) {
    header("Location:/");
  }
}

// Sanitize HTML
function s($html) : string
{
  return htmlspecialchars($html);
}

// Send Canton Value to JS
function cantonValue($canton)
{
  echo "<script>const cantonValue = '$canton';</script>";
}

// Validate Property/Vendor
function validateContent($data)
{
  $validType = ['property', 'vendor'];
  return in_array($data, $validType);
}

// Alert messages
function message($code)
{
  $message = '';

  switch ($code) {
    case 1:
      $message = '¡Anuncio creado correctamente!';
      break;

    case 2:
      $message = '¡Anuncio actualizado correctamente!';
      break;

    case 3:
      $message = '¡Anuncio eliminado correctamente!';
      break;

    case 4:
      $message = '¡Vendedor creado correctamente!';
      break;

    case 5:
      $message = '¡Vendedor actualizado correctamente!';
      break;

    case 6:
      $message = '¡Vendedor eliminado correctamente!';
      break;

    default:
      $message = false;
      break;
  }

  return $message;
}
