<?php 

    require_once "../utils/autoload.php";

    class AdministradoresModelo extends Modelo{
        public $idAdmin;
        public $nombreAdmin;
        public $email;
        public $password;

        public function __construct($idAdmin=""){
            parent::__construct();
            if($idAdmin != ""){
                $this -> idAdmin = $idAdmin;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> idAdmin == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO Administradores (nombreAdmin, email, password) 
            VALUES ('" . $this -> nombreAdmin . "',
                    '" . $this -> email . "',
                    '" . $this -> hashearPassword($this -> password) . "');"; 
            
            $this -> conexion -> query($sql);
        }

        private function hashearPassword($password){
            return password_hash($password,PASSWORD_DEFAULT);
        }

        private function actualizar(){
            $sql = "UPDATE Administradores SET
            nombreAdmin = '" . $this -> nombreAdmin . "',
            email = '" . $this -> email . "',
            password = '" . $this -> hashearPassword($this -> password) . "'
            WHERE idAdmin = " . $this -> idAdmin . ";";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Administradores WHERE
                idAdmin = " . $this -> idAdmin . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> idAdmin = $fila['idAdmin'];
            $this -> nombreAdmin = $fila['nombreAdmin'];
            $this -> email = $fila['email'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Administradores 
                WHERE idAdmin = " . $this ->idAdmin . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Administradores";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new AdministradoresModelo();
                $p -> idAdmin  = $fila['idAdmin'];
                $p -> nombreAdmin = $fila['nombreAdmin'];
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