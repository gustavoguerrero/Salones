<?php 

    require_once "../utils/autoload.php";

    class EventosCalendarioModelo extends Modelo{
        public $id;
        public $titulo;
        public $inicio;
        public $fin;
        public $salon_id;
        public $profesor_id;
        public $administrador_id;
        
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
            $sql = "INSERT INTO Eventos_Calendario (titulo, 
                inicio, fin, salon_id,
                profesor_id, administrador_id) 
                VALUES ('" . $this -> titulo . "',
                        '" . $this -> inicio . "',
                        '" . $this -> fin . "',
                        '" . $this -> salon_id . "',
                        '" . $this -> profesor_id . "',
                        '" . $this -> administrador_id . "'
                    );"; 
            var_dump($sql);
            $this -> conexion -> query($sql);
        }

        private function actualizar(){
            $sql = "UPDATE Eventos_Calendario SET
                titulo = '" . $this -> titulo . "'
                inicio = '" . $this -> inicio . "'
                fin = '" . $this -> fin . "'
                salon_id = '" . $this -> salon_id . "'
                profesor_id = '" . $this -> profesor_id . "'
                administrador_id = '" . $this -> administrador_id . "';";
            $this -> conexion -> query($sql);   
        }

        public function Obtener(){
            $sql = "SELECT * FROM Eventos_Calendario WHERE
                id = " . $this -> id . ";";

            $fila = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> id = $fila['id'];
            $this -> titulo = $fila['titulo'];
            $this -> inicio = $fila['inicio'];
            $this -> fin = $fila['fin'];
            $this -> salon_id = $fila['salon_id'];
            $this -> profesor_id = $fila['profesor_id'];
            $this -> administrador_id = $fila['administrador_id'];
        }


        public function Eliminar(){
            $sql = "DELETE FROM Eventos_Calendario 
                WHERE id = " . $this -> id . ";";
            $this -> conexion -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "select * from Eventos_Calendario";
            $filas = $this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            $resultado = array();
            foreach($filas as $fila){
                $p = new EventosCalendarioModelo();
                $p -> id = $fila['id'];
                $p -> titulo = $fila['titulo'];
                $p -> inicio = $fila['inicio'];
                $p -> fin = $fila['fin'];
                $p -> salon_id = $fila['salon_id'];
                $p -> profesor_id = $fila['profesor_id'];
                $p -> administrador_id = $fila['administrador_id'];
                
                array_push($resultado,$p);
            }
            return $resultado;
        }
    }