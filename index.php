<?php
require_once 'vendor/autoload.php';

use \audrey\CalendarApp\Router;

//Définir un gestionnaire global d'exception
set_exception_handler(function (Throwable $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Internal Server Error', 'message' => $e->getMessage()]);
});

$router = new Router();

try {
  $controller = $router->getController();

  // Vérifier si le contrôleur est une fonction anonyme ou un objet
  if ($controller instanceof Closure) {
    $response = $controller();
  } else {
    $response = $controller->execute();
  }

  // Si la réponse n'est pas déjà envoyée (par exemple par header()/echo dans la méthode du contrôleur)
  if ($response !== null) {
    http_response_code(200);
    echo $response;
  }
} catch (Exception $e) {
  http_response_code(404);
  echo $e->getMessage();
}
