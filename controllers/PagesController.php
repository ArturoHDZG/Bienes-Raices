<?php

namespace Controllers;

//Instances
use MVC\AdminRouter;
use Model\RealEstates;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController
{
  public static function index(AdminRouter $router)
  {
    // Instance
    $result = RealEstates::limitResults(3);

    // Index Unique Header
    $home = true;

    $router->modelData('\Views\pages\Index', [
      'result' => $result,
      'home' => $home
    ]);
    $content = \Views\pages\Index::getContent();
    $router->render($content);
  }

  public static function about(AdminRouter $router)
  {
    $router->modelData('\Views\pages\About', []);
    $content = \Views\pages\About::getContent();
    $router->render($content);
  }

  public static function classifiedAds(AdminRouter $router)
  {
    // Instance
    $result = RealEstates::allTables();

    $router->modelData('\Views\pages\ClassifiedAds', [
      'result' => $result
    ]);
    $content = \Views\pages\ClassifiedAds::getContent();
    $router->render($content);
  }

  public static function showAds(AdminRouter $router)
  {
    // GET data
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $source = $_GET['source'];
    $validTableNames = ['realestates', 'rentals'];

    // Secure URL
    if (!in_array($source, $validTableNames) || !$id) {
      header("Location:/");
      exit;
    }

    $property = RealEstates::findAd($id, $source);

    $router->modelData('\Views\pages\ShowAds', [
      'property' => $property
    ]);
    $content = \Views\pages\ShowAds::getContent();
    $router->render($content);
  }

  public static function blog(AdminRouter $router)
  {
    $router->modelData('\Views\pages\Blog', []);
    $content = \Views\pages\Blog::getContent();
    $router->render($content);
  }

  public static function blogEntry(AdminRouter $router)
  {
    $router->modelData('\Views\pages\BlogEntry', []);
    $content = \Views\pages\BlogEntry::getContent();
    $router->render($content);
  }

  public static function contact(AdminRouter $router)
  {
    $message = null;
    $messageError1 = null;
    $messageError2 = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $contact = $_POST['contact'];

      // Rename fields
      if ($contact['trade'] === 'buy') {
        $trade = 'Comprar o Alquilar';
      } elseif ($contact['trade'] === 'sell') {
        $trade = 'Vender o Alquilar';
      }

      $mail = new PHPMailer(true);
      $mail->setLanguage('es', __DIR__ . '/../vendor/phpmailer/phpmailer/language/');

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a99199ddfd601d';
        $mail->Password = 'adbf99ec0cfd15';
        $mail->SMTPSecure = 'tls';

        //Recipients
        $mail->setFrom('admin@ticocasas.com', 'Administrator');
        $mail->addAddress('admin@ticocasas.com', 'Tico Casas');

        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Formulario de contacto';

        // Defines content
        $content = '<html>';
        $content .= '<p>Tienes un Mensaje Nuevo:</p>';
        $content .= '<p>Nombre: '. $contact['name'] .'</p>';
        $content .= '<p>Mensaje: '. $contact['message'] .'</p>';
        $content .= '<p>Solicita: '. $trade .'</p>';
        $content .= '<p>Presupuesto: '. $contact['budget'] .'</p>';

        // Contact preference
        if ($contact['preference'] === 'prefer-phone') {
          $content .= '<p>Prefiere ser contactado por Teléfono</p>';
          $content .= '<p>Teléfono: '. $contact['phone'] .'</p>';
          $content .= '<p>Fecha: '. $contact['date'] .'</p>';
          $content .= '<p>Hora: '. $contact['time'] .'</p>';
        } elseif ($contact['preference'] === 'prefer-email') {
          $content .= '<p>Prefiere ser contactado por Email</p>';
          $content .= '<p>Email: '. $contact['email'] .'</p>';
        }

        $content .= '</html>';
        $mail->Body = $content;

        $altContent = 'Tienes un Mensaje Nuevo:\n';
        $altContent .= 'Nombre: '. $contact['name'] .'\n';
        $altContent .= 'Mensaje: '. $contact['message'] .'\n';
        $altContent .= 'Solicita: '. $trade .'\n';
        $altContent .= 'Presupuesto: '. $contact['budget'] .'\n';

        // Contact preference
        if ($contact['preference'] === 'prefer-phone') {
          $altContent .= 'Prefiere ser contactado por Teléfono\n';
          $altContent .= 'Teléfono: '. $contact['phone'] .'\n';
          $altContent .= 'Fecha: '. $contact['date'] .'\n';
          $altContent .= 'Hora: '. $contact['time'] .'\n';
        } elseif ($contact['preference'] === 'prefer-email') {
          $altContent .= 'Prefiere ser contactado por Email\n';
          $altContent .= 'Email: '. $contact['email'] .'\n';
        }

        $mail->AltBody = $altContent;

        $mail->send();
        $message = 'Mensaje Enviado con Éxito';
      } catch (\Exception $e) {
        $messageError1 = "No se pudo enviar el mensaje. Error de PHPMailer:";
        $messageError2 = $e->getMessage();
      }
    }

    $router->modelData('\Views\pages\Contact', [
      'message' => $message,
      'messageError1' => $messageError1,
      'messageError2' => $messageError2
    ]);
    $content = \Views\pages\Contact::getContent();
    $router->render($content);
  }
}
