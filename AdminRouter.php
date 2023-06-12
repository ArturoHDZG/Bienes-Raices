<?php

namespace MVC;

class AdminRouter
{
  // Save properties
  public $pathGET = [];
  public $pathPOST = [];

  // Add GET path
  public function get($url, $fn)
  {
    $this->pathGET[$url] = $fn;
  }

  // Add POST path
  public function post($url, $fn)
  {
    $this->pathPOST[$url] = $fn;
  }

  // Validate URL's
  public function checkPaths()
  {
    $currentURL = $_SERVER['PATH_INFO'] ?? '/';
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
      $fn = $this->pathGET[$currentURL] ?? null;
    } else {
      $fn = $this->pathPOST[$currentURL] ?? null;
    }

    if ($fn) {
      call_user_func($fn, $this);
    } else {
      echo 'Página no encontrada';
    }
  }

  // Send Model Data
  public function modelData($path, $data = [])
  {
    $path::addContent($data);
  }


  // Build Views
  public function render($content)
  {
    \Views\Layout::layout($content);
  }
}
