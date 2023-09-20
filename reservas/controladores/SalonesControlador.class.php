<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class SalonesControlador{
        public static function Alta($context){
            
            $u = new SalonesModelo();
            $u -> id = $context['post']['id'];
            $u -> nombre = $context['post']['nombre'];
            $u -> capacidad = $context['post']['capacidad'];
            $u -> ubicacion = $context['post']['ubicacion'];
            $u -> tipo = $context['post']['tipo'];
            
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
            $u = new SalonesModelo($context["post"]["id"]);
            $u -> Eliminar();
            $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Salón eliminado Correctamente"
            ];
            echo json_encode($respuesta);
        }        

        public static function Modificar($context){
            $u = new SalonesModelo($context["post"]["id"]);
            $u -> nombre = $context['post']['nombre'];
            $u -> capacidad = $context['post']['capacidad'];
            $u -> ubicacion = $context['post']['ubicacion'];
            $u -> tipo = $context['post']['tipo'];
            if(!empty($context["post"]["nombre"])){
                $u -> Guardar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Salón Modificado Correctamente"
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
            $u = new SalonesModelo();
            $salones = $u -> ObtenerTodos();
            $resultado = [];
            foreach($salones as $salon){
                $t = [
                    'id' => $salon -> id,
                    'nombre' => $salon -> nombre,
                    'capacidad' => $salon -> capacidad,
                    'ubicacion' => $salon -> ubicacion,
                    'tipo' => $salon -> tipo
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }