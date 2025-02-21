<?php
require_once 'vendor/autoload.php';

use \audrey\CalendarApp\Router;

//Définir un gestionnaire global d'exception
set_exception_handler(function (Throwable $e) {
  http_response_code(500);
  echo "Oups.";
});

$router = new Router();

try {
  $controller = $router->getController();
  $response = $controller->execute();
  http_response_code(200);
  echo $response;
} catch (Exception $e) {
  http_response_code(404);
  echo $e->getMessage();
}
