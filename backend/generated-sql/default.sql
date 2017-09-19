
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
