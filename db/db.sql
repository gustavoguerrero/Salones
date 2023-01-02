USE base;

CREATE TABLE Usuarios(
    idUsuario SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL, 
    email VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (idUsuario)
);

CREATE TABLE Administradores(
    idAdmin SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreAdmin VARCHAR(50) NOT NULL, 
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (idAdmin)
);

CREATE TABLE Salones(
    nombreSalon VARCHAR(50) NOT NULL ,
    capacidad SMALLINT UNSIGNED NOT NULL, 
    tipo ENUM("Actos", "Seminarios", 
    "Hibridos", "Comunes", "Informatica"),
    PRIMARY KEY (nombreSalon)
);

CREATE TABLE Elementos(
    nombreElemento VARCHAR(50) NOT NULL ,
    nombreSalon VARCHAR(50) NOT NULL ,
    PRIMARY KEY (nombreSalon, nombreElemento),
    FOREIGN KEY (nombreSalon) REFERENCES Salones(nombreSalon)
);

CREATE TABLE Reservas(
    idAdmin SMALLINT UNSIGNED NOT NULL,
    nombreSalon VARCHAR(50) NOT NULL ,
    idUsuario SMALLINT UNSIGNED NOT NULL,
    horaFechaReserva DATETIME,
    horaFechaEntrada DATETIME,
    horaFechaSalida DATETIME,
    horaFechaModificacion DATETIME,
    PRIMARY KEY (idAdmin, nombreSalon),
    FOREIGN KEY (idAdmin) REFERENCES Administradores(idAdmin),
    FOREIGN KEY (nombreSalon) REFERENCES Salones(nombreSalon),
    FOREIGN KEY (IdUsuario) REFERENCES Usuarios(idUsuario)
); 
