<?php
    require "../utils/autoload.php";

    Routes::Add("/login", "post", "SesionControlador::IniciarSesion");
    
    Routes::Add("/altaAdmin","post","AdministradoresControlador::Alta");
    Routes::Add("/bajaAdmin","post","AdministradoresControlador::Eliminar");
    Routes::Add("/modificarAdmin","post","AdministradoresControlador::Modificar");
    Routes::Add("/listarAdmin","get","AdministradoresControlador::Listar");
    
    Routes::Add("/altaUser","post","UsuariosControlador::Alta");
    Routes::Add("/bajaUser","post","UsuariosControlador::Eliminar");
    Routes::Add("/modificarUser","post","UsuariosControlador::Modificar");
    Routes::Add("/listarUser","get","UsuariosControlador::Listar");

    Routes::Add("/altaSalon","post","SalonesControlador::Alta");
    Routes::Add("/bajaSalon","post","SalonesControlador::Eliminar");
    Routes::Add("/modificarSalon","post","SalonesControlador::Modificar");
    Routes::Add("/listarSalon","get","SalonesControlador::Listar");

    Routes::Add("/altaElemento","post","ElementosControlador::Alta");
    Routes::Add("/bajaElemento","post","ElementosControlador::Eliminar");
    Routes::Add("/modificarElemento","post","ElementosControlador::Modificar");
    Routes::Add("/listarElemento","get","ElementosControlador::Listar");
    
    

    Routes::Run();
