<?php

    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class AdministradoresControlador{
        public static function Alta($context){
            
            $u = new AdministradoresModelo();
            $u -> nombre = $context['post']['nombre'];
            $u -> email = $context['post']['email'];
            $u -> password = $context['post']['password'];
            try{
                $u -> Guardar();                
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Alta realizada correctamente"
                ];
                echo json_encode($respuesta);
                return;
            }
            catch(mysqli_sql_exception $e){
                $error = $e->getMessage();
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => $error
                ];
                echo json_encode($respuesta);
                return;
            }
        }
        
        public static function Eliminar($context){
            $u = new AdministradoresModelo($context["post"]["id"]);
            try{
                $u -> Eliminar();
                $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Administrador eliminado Correctamente"
                ];
                echo json_encode($respuesta);
                return;
            }
            catch(mysqli_sql_exception $e){
                $error = $e->getMessage();
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => $error
                ];
                echo json_encode($respuesta);
                return;
            }
        }        

        public static function Modificar($context){
            $u = new AdministradoresModelo($context["post"]["id"]);
            $u -> id = $context['post']['id'];
            $u -> nombre = $context['post']['nombre'];
            $u -> email = $context['post']['email'];
            $u -> password = $context['post']['password'];
            if(!empty($context["post"]["id"])){
                try{
                    $u -> Guardar();
                    $respuesta = [
                        "Resultado" => "true",
                        "Mensaje" => "Admnistrador Modificado Correctamente"
                    ];
                    echo json_encode($respuesta);
                }
                catch(mysqli_sql_exception $e){
                    $error = $e->getMessage();
                    $respuesta = [
                        "Resultado" => "false",
                        "Mensaje" => $error
                    ];
                    echo json_encode($respuesta);
                }
            }
            else{
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => "Seleccione Administrador"
                ];
            }          
        }

        public static function Listar(){
            $u = new AdministradoresModelo();
            $administradores = $u -> ObtenerTodos();
            $resultado = [];
            foreach($administradores as $admin){
                $t = [
                    'id' => $admin -> id,
                    'nombres' => $admin -> nombre,
                    'email' => $admin -> email,
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }