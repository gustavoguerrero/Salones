CREATE TABLE Usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombres VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE
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

CREATE TABLE Salones (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  capacidad INT NOT NULL,
  ubicacion VARCHAR(255),
  tipo ENUM('actos','aula',
    'aulaHibrida','seminario',
    'laboratorio','t','labFisica',
    'cin','informatica'
  )
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
  values
  ('admin1', 'admin1@mail.com', 
  '$2a$12$tVHIw5XRQKJHlAkRV2O77.8WkHBzdflIge4Y04rMCkgiFoHik4q1y'),
  ('admin2', 'admin2@mail.com', 
  '$2a$12$tVHIw5XRQKJHlAkRV2O77.8WkHBzdflIge4Y04rMCkgiFoHik4q1y'),
  ('admin3', 'admin3@mail.com', 
  '$2a$12$tVHIw5XRQKJHlAkRV2O77.8WkHBzdflIge4Y04rMCkgiFoHik4q1y')
  ;

insert into Usuarios(
  nombres, apellidos, email)
  VALUES
  ('nombre1', 'apellido1', 'user1@mail.com'),
  ('nombre2', 'apellido2', 'user2@mail.com'), 
  ('nombre3', 'apellido3', 'user3@mail.com'),
  ('nombre4', 'apellido4', 'user4@mail.com');

insert into Salones(
  nombre, capacidad, ubicacion, tipo)
  VALUES
  ("101/103", 90, 'Piso 1', 'aula'),
  ("201/203", 90, 'Piso 2', 'aulaHibrida'),
  ("Sala CIN", 10, 'CIN', 'cin'),
  ("Seminarios 1", 40, 'Piso 0', 'seminario'),
  ("Seminarios 2", 40, 'Piso 0', 'seminario'),
  ("306", 20, 'Piso 3', 'laboratorio'),
  ("T04", 15, 'Piso 0', 't');



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


