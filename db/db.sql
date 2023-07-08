CREATE TABLE Usuarios (
  id VARCHAR(100) PRIMARY KEY NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL
);

CREATE TABLE Administradores (
  id VARCHAR(100) PRIMARY KEY NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE Tipos_Salones (
  id VARCHAR(100) PRIMARY KEY NOT NULL,
  nombre VARCHAR(255) NOT NULL
);

CREATE TABLE Salones (
  id VARCHAR(100) PRIMARY KEY NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  capacidad INT NOT NULL,
  ubicacion VARCHAR(255),
  tipo_salon_id VARCHAR(100),
  FOREIGN KEY (tipo_salon_id) REFERENCES Tipos_Salones(id)
);

CREATE TABLE Inventario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  salon_id VARCHAR(100) NOT NULL,
  item VARCHAR(255) NOT NULL,
  cantidad INT NOT NULL,
  FOREIGN KEY (salon_id) REFERENCES Salones(id)
);

"CREATE TABLE Materias (
  id VARCHAR(100) PRIMARY KEY NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  profesor_id VARCHAR(100),
  FOREIGN KEY (profesor_id) REFERENCES Usuarios(id)
);"

CREATE TABLE Eventos_Calendario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(255) NOT NULL,
  inicio DATETIME NOT NULL,
  fin DATETIME NOT NULL,
  salon_id VARCHAR(100),
  profesor_id VARCHAR(100),
  administrador_id VARCHAR(100),
  FOREIGN KEY (salon_id) REFERENCES Salones(id),
  FOREIGN KEY (profesor_id) REFERENCES Usuarios(id),
  FOREIGN KEY (administrador_id) REFERENCES Administradores(id)
);
