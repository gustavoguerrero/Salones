<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class EventosCalendarioControlador{
        public static function Alta($context){
            
            $u = new EventosCalendarioModelo();
            $u -> id = $context['post']['id'];
            $u -> titulo = $context['post']['titulo'];
            $u -> inicio = $context['post']['inicio'];
            $u -> fin = $context['post']['fin'];
            $u -> salon_id = $context['post']['salon_id'];
            $u -> profesor_id = $context['post']['profesor_id'];
            $u -> administrador_id = $context['post']['administrador_id'];
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
            $u = new EventosCalendarioModelo($context["post"]["id"]);
            try{
                $u -> Eliminar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Reserva eliminada Correctamente"
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
            $u = new EventosCalendarioModelo($context["post"]["id"]);
            $u -> id = $context['post']['id'];
            $u -> titulo = $context['post']['titulo'];
            $u -> inicio = $context['post']['inicio'];
            $u -> fin = $context['post']['fin'];
            $u -> salon_id = $context['post']['salon_id'];
            $u -> profesor_id = $context['post']['profesor_id'];
            $u -> administrador_id = $context['post']['administrador_id'];

            if(!empty($context["post"]["nombreElemento"])){
                try{
                    $u -> Guardar();
                    $respuesta = [
                        "Resultado" => "true",
                        "Mensaje" => "Reserva Modificada Correctamente"
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
            }else{
                $respuesta = [
                    "Resultado" => "false",
                    "Mensaje" => "Error en Modificacion"
                ];
                echo json_encode($respuesta);
            }          
        }

        public static function Listar(){
            $u = new EventosCalendarioModelo();
            $reservas = $u -> ObtenerTodos();
            $resultado = [];
            foreach($reservas as $reserva){
                $t = [
                    'id' => $reserva -> id,
                    'titulo' => $reserva -> titulo,
                    'inicio' => $reserva -> inicio,
                    'fin' => $reserva -> fin,
                    'salon_id' => $reserva -> salon_id,
                    'profesor_id' => $reserva -> profesor_id,
                    'administrador_id' => $reserva -> administrador_id
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;  
        }
    }       