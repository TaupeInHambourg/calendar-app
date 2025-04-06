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
            '/lesson-color/{id}' => "audrey\\CalendarApp\\Controller\\HomeController::getLessonColor",
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

        if (array_key_exists('query', $base_uri)) {
            parse_str($base_uri['query'], $args);
        };

        // GET METHOD
        $method = $_SERVER['REQUEST_METHOD'];
        $resource = $base_uri['path'];

        $isRoute = isset(self::ROUTES[$method][$resource]);

        if (!$isRoute) {
            throw new Exception("404 - Page not found");
        }

        $controllerName = self::ROUTES[$method][$resource];

        if (!class_exists($controllerName)) {
            throw new Exception("404 - Page not found");
        }

        if (isset($args)) {
            $controller = new $controllerName($args);
        }
        $controller = new $controllerName;
        return $controller;
    }

    public function __construct() {}
}
