<?php 

    function PageNotFound(){
        header("HTTP/1.0 404 Not Found");
        echo "404";
        die();
    }