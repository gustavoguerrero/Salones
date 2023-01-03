<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class ElementosControlador{
        public static function Alta($context){
            
            $u = new ElementosModelo();
            $u -> nombreElemento = $context['post']['nombreElemento'];
            $u -> nombreSalon = $context['post']['nombreSalon'];
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
            $u = new ElementosModelo($context["post"]["nombreElemento"]);
            $u -> Eliminar();
            $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Administrador eliminado Correctamente"
            ];
            echo json_encode($respuesta);
        }        

        public static function Modificar($context){
            $u = new ElementosModelo($context["post"]["nombreElemento"]);
            $u -> nombreElemento = $context['post']['nombreElemento'];
            $u -> nombreSalon = $context['post']['nombreSalon'];

            if(!empty($context["post"]["nombreElemento"])){
                $u -> Guardar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Elemento Modificado Correctamente"
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
            $u = new ElementosModelo();
            $elementos = $u -> ObtenerTodos();
            $resultado = [];
            foreach($elementos as $elemento){
                $t = [
                    'nombreElemento' => $elemento -> nombreElemento,
                    'nombreSalon' => $elemento -> nombreSalon
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }