<?php 

    require_once "../utils/autoload.php";

    class UsuariosModelo extends Modelo{
        public $idUsuario;
        public $nombres;
        public $apellidos;
        public $email;

        public function __construct($idUsuario=""){
            parent::__construct();
            if($idUsuario != ""){
                $this -> idUsuario = $idUsuario;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> idUsuario == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Usuarios (nombres, apellidos, email) 
            VALUES ('" . $this -> nombres . "',
                    '" . $this -> apellidos . "',
                    '" . $this -> email . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Usuarios SET
            nombres = '" . $this -> nombres . "',
            apellidos = '" . $this -> apellidos . "',
            email = '" . $this -> email . "',
            WHERE idUsuario = " . $this -> idUsuario . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Usuarios WHERE
                idUsuario = " . $this -> idUsuario . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> idUsuario = $fila['idUsuario'];
            $this -> nombres = $fila['nombres'];
            $this -> apellidos = $fila['apellidos'];
            $this -> email = $fila['email'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Usuarios 
                WHERE idUsuario = " . $this -> idUsuario . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Usuarios";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new UsuariosModelo();
                $p -> idUsuario  = $fila['idUsuario'];
                $p -> nombres = $fila['nombres'];
                $p -> apellidos = $fila['apellidos'];
                $p -> email = $fila['email'];

                array_push($resultado,$p);
            }
            return $resultado;
        }
        
    }