<?php 
    spl_autoload_register(function ($clase){
        if(file_exists("../modelos/$clase.class.php"))
            require_once "../modelos/$clase.class.php";
    
        if(file_exists("../controladores/$clase.class.php"))
            require_once "../controladores/$clase.class.php";
        
    });

    require_once "../config.php";
    require_once "../utils/statusCodes.php";
    require_once "../utils/sessions.php";
    require_once "../utils/httpRequest.php";
    require_once "../utils/render.php";
    require_once "../routing/routes.class.php";


    error_reporting(E_ALL ^ E_NOTICE);  

    session_start();
