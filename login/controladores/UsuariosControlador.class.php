<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class UsuariosControlador{
        public static function Alta($context){
            
            $u = new UsuariosModelo();
            $u -> nombres = $context['post']['nombres'];
            $u -> apellidos = $context['post']['apellidos'];
            $u -> email = $context['post']['email'];
            
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
            $u = new UsuariosModelo($context["post"]["idUsuario"]);
            $u -> Eliminar();
            $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Usuario eliminado Correctamente"
            ];
            echo json_encode($respuesta);
        }        

        public static function Modificar($context){
            $u = new UsuariosModelo($context["post"]["idUsuario"]);
            $u -> idUsuario = $context['post']['idUsuario'];
            $u -> nombres = $context['post']['nombres'];
            $u -> apellidos = $context['post']['apellidos'];
            $u -> email = $context['post']['email'];
            if(!empty($context["post"]["idUsuario"])){
                $u -> Guardar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Usuario Modificado Correctamente"
                ];
                echo json_encode($respuesta);
            }else{
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => "Error en Modificacion"
                ];
                echo json_encode($respuesta);
            }          
        }

        public static function Listar(){
            $u = new UsuariosModelo();
            $usuarios = $u -> ObtenerTodos();
            $resultado = [];
            foreach($usuarios as $usuario){
                $t = [
                    'idUsuario' => $usuario -> idUsuario,
                    'nombre' => $usuario -> nombre,,
                    'email' => $usuario -> email,
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }