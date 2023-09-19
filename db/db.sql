CREATE TABLE Usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombres VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
);

CREATE TABLE gotPassword (
  id INT PRIMARY KEY AUTO_INCREMENT,
  emailUsuario VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  FOREIGN KEY (emailUsuario) REFERENCES Usuarios(email)
);

CREATE TABLE Administradores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE Tipos_Salones (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tipo ENUM('Actos', 'aulas', 
    'aulasHibrid', 'seminario', 
    'laboratorios', 't', 'labFisica', 
    'cim', 'informatica')
);

CREATE TABLE Salones (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  capacidad INT NOT NULL,
  ubicacion VARCHAR(255),
  tipo_salon_id INT,
  FOREIGN KEY (tipo_salon_id) REFERENCES Tipos_Salones(id)
);

CREATE TABLE Inventario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  salon_id INT,
  item VARCHAR(255) NOT NULL,
  cantidad INT NOT NULL,
  FOREIGN KEY (salon_id) REFERENCES Salones(id)
);

CREATE TABLE Eventos_Calendario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(255) NOT NULL,
  inicio DATETIME NOT NULL,
  fin DATETIME NOT NULL,
  salon_id INT,
  profesor_id INT,
  administrador_id INT,
  FOREIGN KEY (salon_id) REFERENCES Salones(id),
  FOREIGN KEY (profesor_id) REFERENCES Usuarios(id),
  FOREIGN KEY (administrador_id) REFERENCES Administradores(id)
);

insert into Administradores(
  nombre, email, password) 
  values('root', 'root@mail.com', 
  '$2a$12$tVHIw5XRQKJHlAkRV2O77.8WkHBzdflIge4Y04rMCkgiFoHik4q1y');

"
CREATE TABLE Materias (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  profesor_id INT,
  FOREIGN KEY (profesor_id) REFERENCES Usuarios(id)
);

CREATE TABLE CodigosSGAE (
  id INT PRIMARY KEY AUTO_INCREMENT,
  materia_id INT,
  codigo VARCHAR(50),
  FOREIGN KEY (materia_id) REFERENCES Materias(id)
);
"


