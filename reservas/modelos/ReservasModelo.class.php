<?php 

    require_once "../utils/autoload.php";

    class ReservasModelo extends Modelo{
        public $idReserva;
        public $idAdmin;
        public $idUsuario;
        public $horaFechaReserva;
        public $horaFechaEntrada;
        public $horaFechaSalida;
        public $horaFechaModificacion;
        
        public $NombreAdmin;
        public $nombreSalon;
        public $nombres;
        public $apellidos;
        
        public function __construct($idReserva=""){
            parent::__construct();
            if($idReserva != ""){
                $this -> idReserva = $idReserva;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> idReserva == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Reservas (idAdmin, 
                nombreSalon, idUsuario, horaFechaReserva,
                horaFechaEntrada, horaFechaSalida, 
                horafechaModificacion) 
                VALUES ('" . $this -> idAdmin . "',
                        '" . $this -> nombreSalon . "',
                        '" . $this -> idUsuario . "',
                        '" . $this -> horaFechaReserva . "',
                        '" . $this -> horaFechaEntrada . "',
                        '" . $this -> horaFechaSalida . "',
                        '" . $this -> horafechaModificacion . "'
                    );"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Reservas SET
                idAdmin = '" . $this -> idAdmin . "'
                nombreSalon = '" . $this -> nombreSalon . "'
                idUsuario = '" . $this -> idUsuario . "'
                horaFechaReserva = '" . $this -> horaFechaReserva . "'
                idReserva = '" . $this -> horaFechaReserva . "'
                horaFechaEntrada = '" . $this -> horaFechaEntrada . "'
                horaFechaSalida = '" . $this -> horaFechaSalida . "'
                WHERE horaFechaModificacion = " . $this -> horaFechaModificacion . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Reservas WHERE
                idReserva = " . $this -> idReserva . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> idReserva = $fila['idReserva'];
            $this -> idAdmin = $fila['idAdmin'];
            $this -> nombreSalon = $fila['nombreSalon'];
            $this -> idUsuario = $fila['idUsuario'];
            $this -> horaFechaReserva = $fila['horaFechaReserva'];
            $this -> horaFechaEntrada = $fila['horaFechaEntrada'];
            $this -> horaFechaSalida = $fila['horaFechaSalida'];
            $this -> horaFechaModificacion = $fila['horaFechaModificacion'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Reservas 
                WHERE idReserva = " . $this -> idReserva . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Reservas";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new ReservasModelo();
                $p -> idReserva = $fila['idReserva'];
                $p -> idAdmin = $fila['idAdmin'];
                $p -> nombreSalon = $fila['nombreSalon'];
                $p -> idUsuario = $fila['idUsuario'];
                $p -> horaFechaReserva = $fila['horaFechaReserva'];
                $p -> horaFechaEntrada = $fila['horaFechaEntrada'];
                $p -> horaFechaSalida = $fila['horaFechaSalida'];
                $p -> horaFechaModificacion = $fila['horaFechaModificacion'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }