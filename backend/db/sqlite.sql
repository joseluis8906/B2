/*basic and test*/
PRAGMA foreign_key=ON;
CREATE TABLE IF NOT EXISTS "User" (
  "Id" INTEGER PRIMARY KEY,
  "UserName" TEXT UNIQUE,
  "Password" TEXT,
  "Active" BOOLEAN
);


CREATE TABLE IF NOT EXISTS "Proveedor"
(
  "Id" INTEGER PRIMARY KEY,
  "Codigo" TEXT UNIQUE,
  "Nombre" TEXT,
  "Origen" TEXT
);
