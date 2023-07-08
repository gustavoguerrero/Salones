<?php 

    require_once "../utils/autoload.php";

    class AdministradoresModelo extends Modelo{
        public $id;
        public $nombre;
        public $email;
        public $password;

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
            $sql = "INSERT INTO Administradores (nombre, email, password) 
            VALUES ('" . $this -> nombre . "',
                    '" . $this -> email . "',
                    '" . $this -> hashearPassword($this -> password) . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function hashearPassword($password){
            return password_hash($password,PASSWORD_DEFAULT);
        }

        private function actualizar(){
            $sql = "UPDATE Administradores SET
            nombre = '" . $this -> nombre . "',
            email = '" . $this -> email . "',
            password = '" . $this -> hashearPassword($this -> password) . "'
            WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Administradores WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> nombre = $fila['nombre'];
            $this -> email = $fila['email'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Administradores 
                WHERE id = " . $this ->id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Administradores";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new AdministradoresModelo();
                $p -> id  = $fila['id'];
                $p -> nombre = $fila['nombre'];
                $p -> email = $fila['email'];
                $p -> password = $fila['password'];

                array_push($resultado,$p);
            }
            return $resultado;
        }

        public function Autenticar(){
            $sql = "SELECT * FROM Administradores WHERE email = '" . $this -> email . "';";
            $resultado = $this -> conexion -> query($sql);
            if($resultado -> num_rows == 0) {
                return false;
            }
            $fila = $resultado -> fetch_all(MYSQLI_ASSOC)[0];
            return $this -> compararPasswords($fila['password']);
        }

        private function compararPasswords($passwordHasheado){
            return password_verify($this -> password, $passwordHasheado);
        }
    }