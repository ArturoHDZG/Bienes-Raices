<?php

namespace Controllers;

//Instances
use MVC\AdminRouter;
use Model\RealEstates;

class PagesController
{
  public static function index(AdminRouter $router)
  {
    // Instance
    $result = RealEstates::limitResults(3);

    // Index Unique Header
    $home = true;

    $router->modelData('\Views\Pages\Index', [
      'result' => $result,
      'home' => $home
    ]);
    $content = \Views\Pages\Index::getContent();
    $router->render($content);
  }

  public static function about(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\About', []);
    $content = \Views\Pages\About::getContent();
    $router->render($content);
  }

  public static function classifiedAds(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\ClassifiedAds', []);
    $content = \Views\Pages\ClassifiedAds::getContent();
    $router->render($content);
  }

  public static function showAds(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\ShowAds', []);
    $content = \Views\Pages\ShowAds::getContent();
    $router->render($content);
  }

  public static function blog(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\Blog', []);
    $content = \Views\Pages\Blog::getContent();
    $router->render($content);
  }

  public static function blogEntry(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\BlogEntry', []);
    $content = \Views\Pages\BlogEntry::getContent();
    $router->render($content);
  }

  public static function contact(AdminRouter $router)
  {
    $router->modelData('\Views\Pages\Contact', []);
    $content = \Views\Pages\Contact::getContent();
    $router->render($content);
  }
}
