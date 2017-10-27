/*basic and test*/
PRAGMA foreign_key=ON;
CREATE TABLE IF NOT EXISTS "Usuario"
(
  "Id" INTEGER PRIMARY KEY,
  "UserName" TEXT UNIQUE,
  "Password" TEXT,
  "Cedula" TEXT UNIQUE,
  "Nombre" TEXT,
  "Apellido" TEXT,
  "Ocupacion" TEXT,
  "Email" TEXT UNIQUE,
  "Direccion" TEXT,
  "Telefono" TEXT,
  "Activo" TEXT
);

CREATE TABLE IF NOT EXISTS "Grupo"
(
  "Id" INTEGER PRIMARY KEY,
  "Nombre" TEXT UNIQUE
);

CREATE TABLE IF NOT EXISTS "UsuarioGrupo" (
  "UsuarioId" INTEGER REFERENCES "Usuario"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "GrupoId" INTEGER REFERENCES "Grupo"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY("UsuarioId", "GrupoId")
);

CREATE TABLE IF NOT EXISTS "Libro" (
  "Id" INTEGER PRIMARY KEY,
  "Isbn" TEXT UNIQUE,
  "Categoria" TEXT,
  "Nombre" TEXT,
  "Editorial" TEXT,
  "Edicion" TEXT,
  "Fecha" DATE,
  "Lugar" TEXT,
  "Estado" TEXT
);

CREATE TABLE IF NOT EXISTS "VideoBean" (
  "Id" INTEGER PRIMARY KEY,
  "Codigo" TEXT UNIQUE,
  "Marca" TEXT,
  "Modelo" TEXT,
  "Especificaciones" TEXT,
  "Accesorios" TEXT,
  "Estado" TEXT
);

CREATE TABLE IF NOT EXISTS "TablaDibujo" (
  "Id" INTEGER PRIMARY KEY,
  "Codigo" TEXT UNIQUE,
  "Marca" TEXT,
  "Especificaciones" TEXT,
  "Estado" TEXT
);
