<?php

class Dispatcher
{
    private static $pureControllerName;
    private static $pureActionName;
    private static $parameters;

    static function start()
    {

        $router = new Router();
        $router->initRoutes();
        $router->getActiveRoute();

        self::$pureControllerName = ucfirst($router->getControllerName());
        self::$pureActionName = strtolower($router->getActionName());
        self::$parameters = $router->getParams();

        $actionName = self::$pureActionName . 'Action';
        $controllerName = self::$pureControllerName . 'Controller';

        if (class_exists($controllerName)) {
            $controller = new $controllerName(self::$parameters, self::$pureControllerName);
            $action = $actionName;

            if (method_exists($controller, $action)) {
                if ($controller->acl->isAllow(strtolower(self::$pureControllerName), self::$pureActionName)) {
                    $controller->$action();
                } else {
                    self::ErrorPage403();
                }
            } else {
                self::ErrorPage404();
            }
        } else {
            self::ErrorPage404();
        }
    }

    private static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . $host . 'error404');
    }

    private static function ErrorPage403()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 403 Access deny');
        header('Status: 403 Access deny');
        header('Location:' . $host . 'error403');
    }
}
