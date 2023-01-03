<?php
    Header("Access-Control-Allow-Origin: *");
    require_once "../utils/autoload.php";

    class ReservasControlador{
        public static function Alta($context){
            
            $u = new ReservasModelo();
            $u -> idAdmin = $context['post']['idAdmin'];
            $u -> nombreSalon = $context['post']['nombreSalon'];
            $u -> idAdmin = $context['post']['idAdmin'];
            $u -> idUsuario = $context['post']['idUsuario'];
            $u -> horaFechaReserva = $context['post']['horaFechaReserva'];
            $u -> horaFechaEntrada = $context['post']['horaFechaEntrada'];
            $u -> horaFechaModificacion = $context['post']['horaFechaModificacion'];
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
            $u = new ReservasModelo($context["post"]["idReserva"]);
            $u -> Eliminar();
            $respuesta = [
                "Resultado" => "true",
                "Mensaje" => "Reserva eliminada Correctamente"
            ];
            echo json_encode($respuesta);
        }        

        public static function Modificar($context){
            $u = new ReservasModelo($context["post"]["idReserva"]);
            $u -> idReserva = $context['post']['idReserva'];
            $u -> idAdmin = $context['post']['idAdmin'];
            $u -> nombreSalon = $context['post']['nombreSalon'];
            $u -> idUsuario = $context['post']['idUsuario'];
            $u -> horaFechaReserva = $context['post']['horaFechaReserva'];
            $u -> horaFechaEntrada = $context['post']['horaFechaEntrada'];
            $u -> horaFechaSalida = $context['post']['horaFechaSalida'];
            $u -> horaFechaModificacion = $context['post']['horaFechaModificacion'];

            if(!empty($context["post"]["nombreElemento"])){
                $u -> Guardar();
                $respuesta = [
                    "Resultado" => "true",
                    "Mensaje" => "Reserva Modificada Correctamente"
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
            $u = new ReservasModelo();
            $reservas = $u -> ObtenerTodos();
            $resultado = [];
            foreach($reservas as $reserva){
                $t = [
                    'idReserva' => $reserva -> idReserva,
                    'idAdmin' => $reserva -> idAdmin,
                    'nombreSalon' => $reserva -> nombreSalon,
                    'idUsuario' => $reserva -> idUsuario,
                    'horaFechaReserva' => $reserva -> horaFechaReserva,
                    'horaFechaEntrada' => $reserva -> horaFechaEntrada,
                    'horaFechaSalida' => $reserva -> horaFechaSalida,
                    'horaFechaModificacion' => $reserva -> horaFechaModificacion
                ];
                array_push($resultado,$t);
            }
            echo json_encode($resultado) ;  
        }
    }