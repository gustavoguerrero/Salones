<?php 

    require_once "../utils/autoload.php";

    class TiposSalonesModelo extends Modelo{
        public $id;
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
            $sql = "INSERT INTO Tipos_Salones (tipo) 
            VALUES ('" . $this -> tipo . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Tipos_Salones SET
            tipo = '" . $this -> tipo . "'
            WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Tipos_Salones WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> tipo = $fila['tipo'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Tipos_Salones 
                WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Tipos_Salones";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new TiposSalonesModelo();
                $p -> id = $fila['id'];
                $p -> tipo = $fila['tipo'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }