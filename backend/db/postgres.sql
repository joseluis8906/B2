CREATE TABLE IF NOT EXISTS "User" (
  "Id" BIGSERIAL PRIMARY KEY,
  "UserName" TEXT UNIQUE,
  "Password" TEXT,
  "Active" BOOLEAN
);

CREATE TABLE IF NOT EXISTS "Tercero" (
  "Id" INTEGER PRIMARY KEY,
  "TipoDeIdentificacion" TEXT NOT NULL,
  "NumeroDeIdentificacion" TEXT NOT NULL,
  "DigitoDeVerificacion" TEXT,
  "PrimerApellido" TEXT,
  "SegundoApellido" TEXT,
  "PrimerNombre" TEXT,
  "OtrosNombres" TEXT,
  "RazonSocial" TEXT,
  "Direccion" TEXT,
  "CodigoDepartamento" TEXT,
  "CodigoMunicipio" TEXT,
  "PaisDeResidencia" TEXT,
  UNIQUE ("TipoDeIdentificacion", "NumeroDeIdentificacion")
);
