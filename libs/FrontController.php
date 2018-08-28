<?php
class FrontController
{
    static function main()
    {
        require 'vendor/autoload.php';
        require 'libs/Config.php'; 
        require 'libs/View.php'; 
 
        require 'config.php'; 
        
        if(! empty($_GET['controller']))
              $controllerName = $_GET['controller'] . 'Controller';
        else
              $controllerName = "loginController";
 
        
        if(! empty($_GET['action']))
              $actionName = $_GET['action'];
        else
              $actionName = "login";
 
       
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
 
        if(is_file($controllerPath))
              require $controllerPath;
        else
              die('El controlador no existe - 404 not found');
 
        if (is_callable(array($controllerName, $actionName)) == false)
        {
            trigger_error ($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
            return false;
        }
        
        $controller = new $controllerName();
        $controller->$actionName();
    }
}
?>