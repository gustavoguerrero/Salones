<?php 

    require_once "../utils/autoload.php";

    class ElementosModelo extends Modelo{
        public $nombreElemento;
        public $nombreSalon;
        
        public function __construct($nombreElemento=""){
            parent::__construct();
            if($nombreElemento != ""){
                $this -> nombreElemento = $nombreElemento;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> nombreElemento == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Elementos (nombreElemento, nombreSalon) 
            VALUES ('" . $this -> nombreElemento . "',
                    '" . $this -> nombreSalon . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Elementos SET
            nombreSalon = '" . $this -> nombreSalon . "'
            WHERE nombreElemento = " . $this -> nombreElemento . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Elementos WHERE
                nombreElemento = " . $this -> nombreElemento . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> nombreElemento = $fila['nombreElemento'];
            $this -> nombreSalon = $fila['nombreSalon'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Elementos 
                WHERE nombreElemento = " . $this -> nombreElemento . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Elementos";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new ElementosModelo();
                $p -> nombreElemento  = $fila['nombreElemento'];
                $p -> nombreSalon = $fila['nombreSalon'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }