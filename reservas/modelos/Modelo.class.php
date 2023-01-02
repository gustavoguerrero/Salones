<?php

    require_once "../utils/autoload.php";

    class Modelo {
        public $IpBaseDeDatos;
        public $NombreBaseDeDatos;
        public $UsuarioBaseDeDatos;
        public $PasswordBaseDeDatos;
        public $PuertoBaseDeDatos;
        
        public $conexion; 


        public function __construct(){
            $this -> incializarDatosDeConexion();
            $this -> conexion = new mysqli(
                $this -> IpBaseDeDatos,
                $this -> UsuarioBaseDeDatos,
                $this -> PasswordBaseDeDatos,
                $this -> NombreBaseDeDatos,
                $this -> PuertoBaseDeDatos
            );
        }

        public function incializarDatosDeConexion(){
            $this -> IpBaseDeDatos = IP_DB;
            $this -> UsuarioBaseDeDatos = USER_DB;
            $this -> PasswordBaseDeDatos = PASS_DB;
            $this -> NombreBaseDeDatos = NAME_DB;
            $this -> PuertoBaseDeDatos = PORT_DB;
        }
    }