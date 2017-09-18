
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
    [Id] INTEGER NOT NULL,
    [UsuarioId] INTEGER,
    [GrupoId] INTEGER,
    PRIMARY KEY ([Id]),
    UNIQUE ([UsuarioId],[GrupoId]),
    UNIQUE ([Id]),
    FOREIGN KEY ([GrupoId]) REFERENCES [Grupo] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY ([UsuarioId]) REFERENCES [Usuario] ([Id])
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
