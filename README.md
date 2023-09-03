# Salones

Modelo

-- Usuarios {
  id (PK),
  nombre,
  email
}

-- Administradores {
  id (PK),
  nombre,
  email,
  password
}

-- Tipos_Salones {
  id (PK),
  nombre
}

-- Salones {
  id (PK),
  nombre,
  capacidad,
  ubicacion,
  tipo_salon_id (FK -> Tipos_Salones.id)
}

-- Inventario {
  id (PK),
  salon_id (FK -> Salones.id),
  item,
  cantidad
}

-- Materias {
  id (PK),
  nombre,
  profesor_id (FK -> Usuarios.id)
}

-- Eventos_Calendario {
  id (PK),
  titulo,
  inicio,
  fin,
  salon_id (FK -> Salones.id),
  profesor_id (FK -> Usuarios.id),
  administrador_id (FK -> Administradores.id)
}


