<?php 

    require_once "../utils/autoload.php";

    class InventarioModelo extends Modelo{
        public $id;
        public $salon_id;
        public $item;
        public $cantidad;
        
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
            $sql = "INSERT INTO Inventario (salon_id, item, cantidad) 
            VALUES ('" . $this -> salon_id . "',
                    '" . $this -> item . "',
                    '" . $this -> cantidad . "',);"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Inventario SET
            salon_id = '" . $this -> salon_id . "',
            item = '" . $this -> item . "',
            cantidad = '" . $this -> cantidad . "',
            WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Inventario WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> salon_id = $fila['salon_id'];
            $this -> item = $fila['item'];
            $this -> cantidad = $fila['cantidad'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Inventario 
                WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Inventario";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new InventarioModelo();
                $p -> id = $fila['id'];
                $p -> salon_id = $fila['salon_id'];
                $p -> item = $fila['item'];
                $p -> cantidad = $fila['cantidad'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
    }