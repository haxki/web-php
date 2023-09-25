<?php
class Router {
    static function route() {
        $controller_name = $_REQUEST['controller'] ? $_REQUEST['controller'] : 'main';
        $controller_file = "app/controllers/".$controller_name.'_controller.php';

        if (file_exists($controller_file))
            include $controller_file;
        else die("ОШИБКА! Файл контроллера $controller_file не найден!");

        $controller_class_name = ucfirst($controller_name).'Controller';
        $controller = new $controller_class_name;

        $action_name = $_REQUEST['action'] ? $_REQUEST['action'] : 'index';

        if(method_exists($controller, $action_name))
            $controller->$action_name();
        else die("ОШИБКА! Отсутствует метод $action_name контроллера $controller_class_name");
    }
}
