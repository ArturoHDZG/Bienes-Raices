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

// Format currency input field
function formatPrice($price)
{
  return str_replace(',', '', $price);
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
