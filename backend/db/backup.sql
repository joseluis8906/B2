PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE [Grupo]
(
    [Id] INTEGER NOT NULL,
    [Nombre] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Nombre]),
    UNIQUE ([Id])
);
INSERT INTO "Grupo" VALUES(1,'Administrador');
INSERT INTO "Grupo" VALUES(2,'Usuario');
CREATE TABLE [Libro]
(
    [Id] INTEGER NOT NULL,
    [Isbn] MEDIUMTEXT,
    [Categoria] MEDIUMTEXT,
    [Nombre] MEDIUMTEXT,
    [Editorial] MEDIUMTEXT,
    [Edicion] MEDIUMTEXT,
    [Fecha] DATETIME,
    [Lugar] MEDIUMTEXT,
    [Estado] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Isbn]),
    UNIQUE ([Id])
);
INSERT INTO "Libro" VALUES(1,'0001-1','Libro','Librito 1','Inventada','1ra Edicion','2017-10-03','Gamarra','Disponible');
INSERT INTO "Libro" VALUES(2,'0002-2','Libro','Librito 2','Inventada 2','2da Edición','2017-10-03 00:00:00.000000','Gamarra','Disponible');
CREATE TABLE [TablaDibujo]
(
    [Id] INTEGER NOT NULL,
    [Codigo] MEDIUMTEXT,
    [Marca] MEDIUMTEXT,
    [Especificaciones] MEDIUMTEXT,
    [Estado] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Codigo]),
    UNIQUE ([Id])
);
INSERT INTO "TablaDibujo" VALUES(1,'0001','Studmark','30x30 cm','Disponible');
INSERT INTO "TablaDibujo" VALUES(2,'0002','Plex','45x45 cm','Disponible');
CREATE TABLE [Usuario]
(
    [Id] INTEGER NOT NULL,
    [UserName] MEDIUMTEXT,
    [Password] MEDIUMTEXT,
    [Cedula] MEDIUMTEXT,
    [Nombre] MEDIUMTEXT,
    [Apellido] MEDIUMTEXT,
    [Ocupacion] MEDIUMTEXT,
    [Email] MEDIUMTEXT,
    [Direccion] MEDIUMTEXT,
    [Telefono] MEDIUMTEXT,
    [Activo] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Email]),
    UNIQUE ([Cedula]),
    UNIQUE ([UserName]),
    UNIQUE ([Id])
);
INSERT INTO "Usuario" VALUES(1,'root','$2a$10$G5pWCCb5PyhcYFXdI2/gLe1HOA1VfWVNP/siiEm7xWlP05RkLCMTe','root',NULL,NULL,NULL,NULL,NULL,NULL,'Si');
INSERT INTO "Usuario" VALUES(2,'1098671330','$2a$10$8ua7DuKx7y9FFxHnwt58keFjwIj3AG2wK1g43B0tBfcCUPtA3kXey','1098671330','Jose','Cáceres','Ingeniería de sistemas','joseluis8906@opmbx.org','Cll 7 # 6 - 09','3182171760','Si');
INSERT INTO "Usuario" VALUES(4,'1066432343','$2a$10$1LZ3B/PMSRXO6GBO/MdLn.XMEo8HpkSZKFjxdUhd.sC3De4GLPul6','1066432343','Joiner','Sanchez','Ing. de sistemas','joiner@gmail.com','Cll 4 # 1 - 09','3183245674','Si');
INSERT INTO "Usuario" VALUES(5,'',NULL,'1066432334',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
CREATE TABLE [UsuarioGrupo]
(
    [UsuarioId] INTEGER NOT NULL,
    [GrupoId] INTEGER NOT NULL,
    PRIMARY KEY ([UsuarioId],[GrupoId]),
    UNIQUE ([UsuarioId],[GrupoId]),
    FOREIGN KEY ([GrupoId]) REFERENCES [Grupo] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY ([UsuarioId]) REFERENCES [Usuario] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
INSERT INTO "UsuarioGrupo" VALUES(1,1);
INSERT INTO "UsuarioGrupo" VALUES(2,1);
INSERT INTO "UsuarioGrupo" VALUES(3,1);
INSERT INTO "UsuarioGrupo" VALUES(4,2);
CREATE TABLE [VideoBean]
(
    [Id] INTEGER NOT NULL,
    [Codigo] MEDIUMTEXT,
    [Marca] MEDIUMTEXT,
    [Modelo] MEDIUMTEXT,
    [Especificaciones] MEDIUMTEXT,
    [Accesorios] MEDIUMTEXT,
    [Estado] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Codigo]),
    UNIQUE ([Id])
);
INSERT INTO "VideoBean" VALUES(1,'0001','Epson','2015','1000 lumens.','Cable Hdmi, Cable de poder.','Disponible');
INSERT INTO "VideoBean" VALUES(2,'0002','Epson','2017','800 lumens.','Cable hdmi y cable de poder','Disponible');
CREATE TABLE "Prestamo" (
  "Id" INTEGER PRIMARY KEY,
  "UsuarioId" INTEGER REFERENCES "Usuario"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "LibroId" INTEGER REFERENCES "Libro"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "VideoBeanId" INTEGER REFERENCES "VideoBean"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "TablaDibujoId" INTEGER REFERENCES "TablaDibujo"("Id") ON DELETE CASCADE ON UPDATE CASCADE,
  "FechaReserva" DATE,
  "FechaPrestamo" DATE,
  "FechaDevolucion" DATE,
  "Estado" TEXT,
  "Sancion" DECIMAL
);
INSERT INTO "Prestamo" VALUES(1,4,2,NULL,NULL,'2017-12-02 00:00:00.000000','2017-12-02','2017-12-02','Devuelto',NULL);
COMMIT;
