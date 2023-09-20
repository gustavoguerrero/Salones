<?php 

    require_once "../utils/autoload.php";

    class SalonesModelo extends Modelo{
        public $id;
        public $nombre;
        public $capacidad;
        public $ubicacion;
        public $tipo;
        
        public function __construct($id=""){
            parent::__construct();
            if($id != ""){
                $this -> id = $id;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> id == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Salones (nombre, capacidad, ubicacion, tipo) 
            VALUES ('" . $this -> nombre . "',
                    '" . $this -> capacidad . "',
                    '" . $this -> ubicacion . "',
                    '" . $this -> tipo . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Salones SET
            nombre = '" . $this -> nombre . "',
            capacidad = '" . $this -> capacidad . "',
            ubicacion = '" . $this -> ubicacion . "',
            tipo = '" . $this -> tipo . "'
            WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Salones WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> nombre = $fila['nombre'];
            $this -> capacidad = $fila['capacidad'];
            $this -> ubicacion = $fila['ubicacion'];
            $this -> tipo = $fila['tipo'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Salones 
                WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Salones";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new SalonesModelo();
                $p -> id  = $fila['id'];
                $p -> nombre  = $fila['nombre'];
                $p -> capacidad = $fila['capacidad'];
                $p -> ubicacion = $fila['ubicacion'];
                $p -> tipo = $fila['tipo'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }