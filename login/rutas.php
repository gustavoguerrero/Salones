<?php
    require "../utils/autoload.php";

    Routes::Add("/login", "post", "SesionControlador::IniciarSesion");
    
    Routes::Add("/altaAdmin","post","AdmnistradoresControlador::Alta");
    Routes::Add("/bajaAdmin","post","AdmnistradoresControlador::Eliminar");
    Routes::Add("/modificarAdmin","post","AdmnistradoresControlador::Modificar");
    Routes::Add("/listarAdmin","get","AdmnistradoresControlador::Listar");
    
    Routes::Add("/altaUser","post","UsuariosControlador::Alta");
    Routes::Add("/bajaUser","post","UsuariosControlador::Eliminar");
    Routes::Add("/modificarUser","post","UsuariosControlador::Modificar");
    Routes::Add("/listarUser","get","UsuariosControlador::Listar");
    
    

    Routes::Run();
