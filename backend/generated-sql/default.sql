
-----------------------------------------------------------------------
-- Usuario
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Usuario];

CREATE TABLE [Usuario]
(
    [Id] INTEGER NOT NULL,
    [Cedula] MEDIUMTEXT,
    [Nombre] MEDIUMTEXT,
    [Apellido] MEDIUMTEXT,
    [Activo] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Cedula]),
    UNIQUE ([Id])
);
