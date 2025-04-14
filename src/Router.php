<?php

namespace  audrey\CalendarApp;

use Exception;

class Router
{
    public const ROUTES = [
        "GET" => [
            "/" => "audrey\\CalendarApp\\Controller\\HomeController",
            "/api/lessons/{id}" => "audrey\\CalendarApp\\Controller\\LessonController::getLesson",

        ],
        "POST" => [
            "/drag-drop" => "audrey\\CalendarApp\\Controller\\DragDropController",
            '/lesson-color/{id}' => "audrey\\CalendarApp\\Controller\\LessonController::getLessonColor",
            "/lessons" => "audrey\\CalendarApp\\Controller\\LessonController::createLesson",
        ],
        "PUT" => [
            "/api/lessons/{id}" => "audrey\\CalendarApp\\Controller\\LessonController::updateLesson",
        ]
    ];

    /**
     * @throws Exception
     */
    public function getController()
    {
        // GET URI
        $base_uri = parse_url($_SERVER['REQUEST_URI']);
        $resource = $base_uri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Initialiser le tableau des arguments
        $args = [];

        // Récupération des paramètres de la requête (query parameters)
        if (array_key_exists('query', $base_uri)) {
            parse_str($base_uri['query'], $queryArgs);
            $args = array_merge($args, $queryArgs);
        }

        // Recherche de la route correspondante et extraction des paramètres de route
        $matchedRoute = null;
        $routeParams = [];

        foreach (self::ROUTES[$method] as $routePattern => $controller) {
            $pattern = $this->convertRouteToRegex($routePattern);
            if (preg_match($pattern, $resource, $matches)) {
                $matchedRoute = $routePattern;

                // Extraction des paramètres de l'URL
                $paramNames = $this->extractParamNames($routePattern);
                foreach ($paramNames as $index => $name) {
                    $routeParams[$name] = $matches[$index + 1];
                }

                break;
            }
        }

        // Si aucune route ne correspond
        if ($matchedRoute === null) {
            throw new Exception("404 - Page not found");
        }

        // Fusionner les paramètres de route avec les autres arguments
        $args = array_merge($args, $routeParams);

        // Récupérer le contrôleur et la méthode
        $controllerInfo = self::ROUTES[$method][$matchedRoute];

        // Vérifier si on a un contrôleur avec une méthode spécifique
        if (strpos($controllerInfo, '::') !== false) {
            list($controllerName, $methodName) = explode('::', $controllerInfo);

            if (!class_exists($controllerName)) {
                throw new Exception("404 - Controller not found");
            }

            $controller = new $controllerName();

            if (!method_exists($controller, $methodName)) {
                throw new Exception("404 - Method not found");
            }

            // Retourner un callable pour exécuter la méthode avec les arguments
            return function () use ($controller, $methodName, $args) {
                return call_user_func_array([$controller, $methodName], $args);
            };
        } else {
            // Cas d'un contrôleur sans méthode spécifique
            $controllerName = $controllerInfo;

            if (!class_exists($controllerName)) {
                throw new Exception("404 - Controller not found");
            }

            return new $controllerName($args);
        }
    }

    /**
     * Convertit un motif de route en expression régulière
     */
    private function convertRouteToRegex($route)
    {
        $pattern = preg_replace('/{([a-zA-Z0-9_]+)}/', '([^/]+)', $route);
        return '#^' . $pattern . '$#';
    }

    /**
     * Extrait les noms des paramètres d'une route
     */
    private function extractParamNames($route)
    {
        preg_match_all('/{([a-zA-Z0-9_]+)}/', $route, $matches);
        return $matches[1];
    }

    public function __construct() {}
}
