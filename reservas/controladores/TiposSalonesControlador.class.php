<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class TiposSalonesControlador{
        public static function Alta($context){
            
            $u = new TiposSalonesModelo();
            $u -> nombre = $context['post']['nombreSalon'];
            
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
            $u = new TiposSalonesModelo($context["post"]["nombre"]);
            $u -> Eliminar();
            $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Administrador eliminado Correctamente"
            ];
            echo json_encode($respuesta);
        }        

        public static function Modificar($context){
            $u = new TiposSalonesModelo($context["post"]["id"]);
            $u -> nombre = $context['post']['nombre'];
            if(!empty($context["post"]["nombreSalon"])){
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
                    'nombreSalon' => $salon -> nombreSalon,
                    'capacidad' => $salon -> capacidad,
                    'tipo' => $salon -> tipo,
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;            
        }
    }