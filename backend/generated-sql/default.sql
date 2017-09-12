
-----------------------------------------------------------------------
-- Proveedor
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [Proveedor];

CREATE TABLE [Proveedor]
(
    [Id] INTEGER NOT NULL,
    [Codigo] MEDIUMTEXT,
    [Nombre] MEDIUMTEXT,
    [Origen] MEDIUMTEXT,
    PRIMARY KEY ([Id]),
    UNIQUE ([Codigo]),
    UNIQUE ([Id])
);

-----------------------------------------------------------------------
-- User
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [User];

CREATE TABLE [User]
(
    [Id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [UserName] MEDIUMTEXT,
    [Password] MEDIUMTEXT,
    UNIQUE ([UserName]),
    UNIQUE ([Id])
);
