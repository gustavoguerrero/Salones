<?php 

    require_once "../utils/autoload.php";

    class SalonesModelo extends Modelo{
        public $nombreSalon;
        public $capacidad;
        public $tipo;
        
        public function __construct($nombreSalon=""){
            parent::__construct();
            if($nombreSalon != ""){
                $this -> nombreSalon = $nombreSalon;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> nombreSalon == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Salones (nombreSalon, capacidad, tipo) 
            VALUES ('" . $this -> nombreSalon . "',
                    '" . $this -> capacidad . "',
                    '" . $this -> tipo . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Salones SET
            capacidad = '" . $this -> capacidad . "',
            tipo = '" . $this -> tipo . "'
            WHERE nombreSalon = " . $this -> nombreSalon . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Salones WHERE
                nombreSalon = " . $this -> nombreSalon . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> nombreSalon = $fila['nombreSalon'];
            $this -> capacidad = $fila['capacidad'];
            $this -> tipo = $fila['tipo'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Salones 
                WHERE nombreSalon = " . $this -> nombreSalon . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Salones";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new SalonesModelo();
                $p -> nombreSalon  = $fila['nombreSalon'];
                $p -> capacidad = $fila['capacidad'];
                $p -> tipo = $fila['tipo'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }