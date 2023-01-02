<?php 
    require '../utils/autoload.php';

    class Routes {
        private static $Url;
        private static $Method;
        private static $routes = Array();
        public static function Add($url,$metodo,$funcion){
            array_push(self::$routes,[
                'url' => $url,
                'funcion' => $funcion,
                'metodo' => $metodo,
                'vista' => null,
                'tipo' => "controlador"
            ]);
        }

        public static function AddView($url,$vista){
            array_push(self::$routes,[
                'url' => $url,
                'funcion' => null,
                'metodo' => "get",
                'tipo' => "vista",
                'vista' => $vista
            ]);
        }

        public static function Run(){
            self::$Url = $_SERVER['REQUEST_URI'];
            self::$Method = strtolower($_SERVER['REQUEST_METHOD']);
            $resultado = self::findRoute(self::$Url,self::$Method);
            if($resultado['notFound']) PageNotFound();
            if($resultado['tipo'] === "vista") self::cargarVista($resultado['vista']);
            if($resultado['tipo'] === "controlador") self::cargarControlador($resultado['funcion']);
        }

        private static function findRoute($Url,$Method){
            foreach(self::$routes as $route){
                if(self::evaluarRuta($route)){
                    $resultado = [
                        'funcion' => $route['funcion'],
                        'tipo' => $route['tipo'],
                        'notFound' => false,
                        'vista' => $route['vista']
                    ];
                    return $resultado;
                }
            }
            
            $resultado = [
                'notFound' => true
            ];
            return $resultado;
        }

        private static function evaluarRuta($route){
            if(self::$Url === $route['url'] && self::$Method === $route['metodo'] && $route['tipo'] === 'controlador')
                return true;

            if(self::$Url === $route['url'] && self::$Method === "get" && $route['tipo'] === "vista")
                return true;
            return false;
        }

        private static function cargarVista($vista){
            renderVista($vista);
        }

        private static function cargarControlador($funcion){
            $context = [
                'get' => $_GET,
                'post' => $_POST,
                'server' => $_SERVER,
                'session' => $_SESSION
            ];
            call_user_func($funcion,$context);
        }
    }