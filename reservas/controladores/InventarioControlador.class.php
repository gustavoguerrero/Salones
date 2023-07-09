<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class InventarioControlador{
        public static function Alta($context){
            
            $u = new InventarioModelo();
            $u -> salon_id = $context['post']['salon_id'];
            $u -> item = $context['post']['item'];
            $u -> cantidad = $context['post']['cantidad'];
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
            $u = new InventarioModelo($context["post"]["id"]);
            try{
                $u -> Eliminar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Administrador eliminado Correctamente"
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
                return;
            }
        }        

        public static function Modificar($context){
            $u = new InventarioModelo($context["post"]["id"]);
            $u -> salon_id = $context['post']['salon_id'];
            $u -> item = $context['post']['item'];
            $u -> cantidad = $context['post']['cantidad'];
            if(!empty($context["post"]["nombreElemento"])){
                try{
                    $u -> Guardar();
                    $respuesta = [
                        "Resultado" => "true",
                        "Mensaje" => "Elemento Modificado Correctamente"
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
            }else{
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => "Error en Modificacion"
                ];
                echo json_encode($respuesta);
            }          
        }

        public static function Listar(){
            $u = new InventarioModelo();
            $elementos = $u -> ObtenerTodos();
            $resultado = [];
            foreach($elementos as $elemento){
                $t = [
                    'salon_id' => $elemento -> salon_id,
                    'item' => $elemento -> item,
                    'cantidad' => $elemento -> cantidad,

                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }