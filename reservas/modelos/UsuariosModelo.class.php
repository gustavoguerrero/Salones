<?php 

    require_once "../utils/autoload.php";

    class UsuariosModelo extends Modelo{
        public $id;
        public $nombre;
        public $email;

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
            $sql = "INSERT INTO Usuarios (nombre, email) 
            VALUES ('" . $this -> nombre . "',
                    '" . $this -> email . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Usuarios SET
            nombre = '" . $this -> nombre . "',
            email = '" . $this -> email . "',
            WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Usuarios WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> nombre = $fila['nombre'];
            $this -> email = $fila['email'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Usuarios 
                WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Usuarios;";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new UsuariosModelo();
                $p -> id  = $fila['id'];
                $p -> nombre = $fila['nombre'];
                $p -> email = $fila['email'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
        
    }