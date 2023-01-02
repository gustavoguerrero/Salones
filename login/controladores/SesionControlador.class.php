<?php 
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class SesionControlador {

        public static function IniciarSesion($context){
            $u = new AdministradoresModelo();
            $u -> email = $context['post']['email'];
            $u -> password = $context['post']['password'];
            if($u -> Autenticar()){
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Credenciales validas"
                ];
                echo json_encode($respuesta);
                return;
            }
            $respuesta = [
                "Resultado" => "false",
                "Mensaje" => "Credenciales invalidas"
            ];
            echo json_encode($respuesta);
            return;
        }
    }