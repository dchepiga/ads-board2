<?php

class Dispatcher
{
    private static $pureControllerName;
    private static $pureActionName;

    static function start()
    {

        $router = new Router();
        $router->initRoutes();
        $router->getActiveRoute();

        self::$pureControllerName = ucfirst($router->getControllerName());
        self::$pureActionName = strtolower($router->getActionName());

        $actionName = self::$pureActionName . 'Action';
        $controllerName = self::$pureControllerName . 'Controller';


        $controllerFile = $controllerName . '.php';
        $controllerPath = "application/controllers/" . $controllerFile;
        if (file_exists($controllerPath)) {
            include $controllerPath;
        } else {
            self::ErrorPage404();
        }

        if (class_exists(self::$pureControllerName)){
            $model = new self::$pureControllerName();
            Registry::set('model', $model);
        }

        $controller = new $controllerName(self::$pureActionName);
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
