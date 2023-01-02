<?php 
    function SessionCreate($name, $data){
        $_SESSION[$name] = $data;
    }