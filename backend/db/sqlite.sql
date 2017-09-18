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
  "Id" INTEGER PRIMARY KEY,
  "UsuarioId" INTEGER REFERENCES "Usuario"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "GrupoId" INTEGER REFERENCES "Grupo"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  UNIQUE("UsuarioId", "GrupoId")
);
