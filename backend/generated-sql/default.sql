
-----------------------------------------------------------------------
-- Grupo
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Grupo];

CREATE TABLE [Grupo]
(
    [Id] INTEGER NOT NULL,
    [Nombre] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Nombre]),
    UNIQUE ([Id])
);

-----------------------------------------------------------------------
-- Libro
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Libro];

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

-----------------------------------------------------------------------
-- TablaDibujo
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [TablaDibujo];

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

-----------------------------------------------------------------------
-- Usuario
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Usuario];

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

-----------------------------------------------------------------------
-- UsuarioGrupo
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [UsuarioGrupo];

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

-----------------------------------------------------------------------
-- VideoBean
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [VideoBean];

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

-----------------------------------------------------------------------
-- Prestamo
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Prestamo];

CREATE TABLE [Prestamo]
(
    [Id] INTEGER NOT NULL,
    [UsuarioId] INTEGER,
    [LibroId] INTEGER,
    [VideoBeanId] INTEGER,
    [TablaDibujoId] INTEGER,
    [FechaReserva] DATETIME,
    [FechaPrestamo] DATETIME,
    [FechaDevolucion] DATETIME,
    [Estado] MEDIUMTEXT,
    [Sancion] DECIMAL,
    PRIMARY KEY ([Id]),
    UNIQUE ([Id]),
    FOREIGN KEY ([TablaDibujoId]) REFERENCES [TablaDibujo] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY ([VideoBeanId]) REFERENCES [VideoBean] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY ([LibroId]) REFERENCES [Libro] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY ([UsuarioId]) REFERENCES [Usuario] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
