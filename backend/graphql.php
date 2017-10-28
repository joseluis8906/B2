<?php
// Test this using following command
// php -S localhost:8080 ./graphql.php &
// curl http://localhost:8080 -d '{"query": "query { echo(message: \"Hello World\") }" }'
// curl http://localhost:8080 -d '{"query": "mutation { sum(x: 2, y: 2) }" }'
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated-conf/config.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils\Utils;

class GQUsuario {
  public $Id;
  public $UserName;
  public $Password;
  public $Cedula;
  public $Nombre;
  public $Apellido;
  public $Ocupacion;
  public $Email;
  public $Direccion;
  public $Telefono;
  Public $Activo;
  Public $Grupos;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQGrupo {
  public $Id;
  public $Nombre;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQLibro {
  public $Id;
  Public $Categoria;
  public $Isbn;
  public $Nombre;
  public $Editorial;
  public $Edicion;
  public $Fecha;
  public $Lugar;
  public $Estado;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQVidebean {
  public $Id;
  public $Codigo;
  public $marca;
  public $Modelo;
  public $Especificaciones;
  public $Accesorios;
  public $Estado;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQTabladibujo {
  public $Id;
  public $Codigo;
  public $marca;
  public $Especificaciones;
  public $Estado;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

try {
  //Tipo de objeto Usuario
  $Grupo = new ObjectType([
    'name' => 'Grupo',
    'description' => 'Objeto que describe un grupo',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Nombre' => ['type' => Type::string()],
    ]
  ]);

  $Usuario = new ObjectType([
    'name' => 'Usuario',
    'description' => 'Objeto que describe un usuario',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'UserName' => ['type' => Type::string()],
        'Password' => ['type' => Type::string()],
        'Cedula' => ['type' => Type::string()],
        'Nombre' => ['type' => Type::string()],
        'Apellido' => ['type' => Type::string()],
        'Ocupacion' => ['type' => Type::string()],
        'Email' => ['type' => Type::string()],
        'Direccion' => ['type' => Type::string()],
        'Telefono' => ['type' => Type::string()],
        'Activo' => ['type' => Type::string()],
        'Grupos' => ['type' => Type::listOf($Grupo)]
    ]
  ]);

  $Libro = new ObjectType([
    'name' => 'Libro',
    'description' => 'Objeto que describe un libro',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Isbn' => ['type' => Type::string()],
        'Categoria' => ['type' => Type::string()],
        'Nombre' => ['type' => Type::string()],
        'Editorial' => ['type' => Type::string()],
        'Edicion' => ['type' => Type::string()],
        'Fecha' => ['type' => Type::string()],
        'Lugar' => ['type' => Type::string()],
        'Estado' => ['type' => Type::string()]
    ]
  ]);


  $Videobean = new ObjectType([
    'name' => 'Videobean',
    'description' => 'Objeto que describe un videobean',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Codigo' => ['type' => Type::string()],
        'Marca' => ['type' => Type::string()],
        'Modelo' => ['type' => Type::string()],
        'Especificaciones' => ['type' => Type::string()],
        'Accesorios' => ['type' => Type::string()],
        'Estado' => ['type' => Type::string()]
    ]
  ]);

  $Tabladibujo = new ObjectType([
    'name' => 'Tabladibujo',
    'description' => 'Objeto que describe un videobean',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Codigo' => ['type' => Type::string()],
        'Marca' => ['type' => Type::string()],
        'Especificaciones' => ['type' => Type::string()],
        'Estado' => ['type' => Type::string()]
    ]
  ]);

  //Tipo de objeto Query
  $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
          'Usuarios' => [
              'type' => Type::listOf($Usuario),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'UserName' => ['type' => Type::string()],
                  'Password' => ['type' => Type::string()],
                  'Cedula' => ['type' => Type::string()],
                  'Nombre' => ['type' => Type::string()],
                  'Apellido' => ['type' => Type::string()],
                  'Ocupacion' => ['type' => Type::string()],
                  'Email' => ['type' => Type::string()],
                  'Direccion' => ['type' => Type::string()],
                  'Telefono' => ['type' => Type::string()],
                  'Activo' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $usuarios = UsuarioQuery::create();
                if(isset($args['Id'])) {$usuarios->filterById($args['Id']);}
                if(isset($args['UserName'])) {$usuarios->filterByUserName($args['UserName']);}
                if(isset($args['Password'])) {$usuarios->filterByPassword($args['Password']);}
                if(isset($args['Cedula'])) {$usuarios->filterByCedula($args['Cedula']);}
                if(isset($args['Nombre'])) {$usuarios->filterByNombre($args['Nombre']);}
                if(isset($args['Apellido'])) {$usuarios->filterByApellido($args['Apellido']);}
                if(isset($args['Ocupacion'])) {$usuarios->filterByOcupacion($args['Ocupacion']);}
                if(isset($args['Email'])) {$usuarios->filterByEmail($args['Email']);}
                if(isset($args['Direccion'])) {$usuarios->filterByDireccion($args['Direccion']);}
                if(isset($args['Telefono'])) {$usuarios->filterByTelefono($args['Telefono']);}
                if(isset($args['Activo'])) {$usuarios->filterByActivo($args['Activo']);}
                $usuarios->find();

                $R = [];

                foreach ($usuarios as $usuario) {
                  $G = [];

                  $grupos = $usuario->getGrupos();

                  foreach ($grupos as $grupo) {
                    $G[] = new GQGrupo([
                      'Id' => $grupo->getId(),
                      'Nombre' => $grupo->getNombre()
                    ]);
                  }

                  $R[] = new GQUsuario([
                    'Id' => $usuario->getId(),
                    "UserName" => $usuario->getUserName(),
                    "Password" => $usuario->getPassword(),
                    "Cedula" => $usuario->getCedula(),
                    "Nombre" => $usuario->getNombre(),
                    'Apellido' => $usuario->getApellido(),
                    'Ocupacion' => $usuario->getOcupacion(),
                    'Email' => $usuario->getEmail(),
                    'Direccion' => $usuario->getDireccion(),
                    'Telefono' => $usuario->getTelefono(),
                    'Activo' => $usuario->getActivo(),
                    'Grupos' => $G
                  ]);
                }
                return $R;
              }
          ],
          'Grupos' => [
              'type' => Type::listOf($Grupo),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Nombre' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $grupos = GrupoQuery::create();
                if(isset($args['Id'])) {$grupos->filterById($args['Id']);}
                if(isset($args['Nombre'])) {$grupos->filterByNombre($args['Nombre']);}
                $grupos->find();

                $R = [];

                foreach ($grupos as $grupo) {
                    $R[] = new GQGrupo([
                      'Id' => $grupo->getId(),
                      "Nombre" => $grupo->getNombre()
                    ]);
                }
                return $R;
              }
          ],
          'Libros' => [
              'type' => Type::listOf($Libro),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Categoria' => ['type' => Type::string()],
                  'Isbn' => ['type' => Type::string()],
                  'Nombre' => ['type' => Type::string()],
                  'Editorial' => ['type' => Type::string()],
                  'Edicion' => ['type' => Type::string()],
                  'Fecha' => ['type' => Type::string()],
                  'Lugar' => ['type' => Type::string()],
                  'Estado' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $libros = LibroQuery::create();
                if(isset($args['Id'])) {$libros->filterById($args['Id']);}
                if(isset($args['Categoria'])) {$libros->filterByCategoria($args['Categoria']);}
                if(isset($args['Isbn'])) {$libros->filterByIsbn($args['Isbn']);}
                if(isset($args['Nombre'])) {$libros->filterByNombre($args['Nombre']);}
                if(isset($args['Editorial'])) {$libros->filterByEditorial($args['Editorial']);}
                if(isset($args['Edicion'])) {$libros->filterByEdicion($args['Edicion']);}
                if(isset($args['Fecha'])) {$libros->filterByFecha($args['Fecha']);}
                if(isset($args['Lugar'])) {$libros->filterByLugar($args['Lugar']);}
                if(isset($args['Estado'])) {$libros->filterByEstado($args['Estado']);}
                $libros->find();

                $R = [];

                foreach ($libros as $libro) {
                    $R[] = new GQLibro([
                      'Id' => $libro->getId(),
                      "Categoria" => $libro->getCategoria(),
                      "Isbn" => $libro->getIsbn(),
                      "Nombre" => $libro->getNombre(),
                      "Editorial" => $libro->getEditorial(),
                      "Edicion" => $libro->getEdicion(),
                      "Fecha" => $libro->getFecha()->format('Y-m-d'),
                      "Lugar" => $libro->getLugar(),
                      "Estado" => $libro->getEstado()
                    ]);
                }
                return $R;
              }
          ],
          'Videobeans' => [
              'type' => Type::listOf($Videobean),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Codigo' => ['type' => Type::string()],
                  'Marca' => ['type' => Type::string()],
                  'Modelo' => ['type' => Type::string()],
                  'Especificaciones' => ['type' => Type::string()],
                  'Accesorios' => ['type' => Type::string()],
                  'Estado' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $libros = LibroQuery::create();
                if(isset($args['Id'])) {$libros->filterById($args['Id']);}
                if(isset($args['Codigo'])) {$libros->filterByCodigo($args['Codigo']);}
                if(isset($args['Marca'])) {$libros->filterByMarca($args['Marca']);}
                if(isset($args['Modelo'])) {$libros->filterByModelo($args['Modelo']);}
                if(isset($args['Especificaciones'])) {$libros->filterByEspecificaciones($args['Especificaciones']);}
                if(isset($args['Accesorios'])) {$libros->filterByAccesorios($args['Accesorios']);}
                if(isset($args['Estado'])) {$libros->filterByEstado($args['Estado']);}
                $libros->find();

                $R = [];

                foreach ($libros as $libro) {
                    $R[] = new GQLibro([
                      'Id' => $libro->getId(),
                      "Codigo" => $libro->getCodigo(),
                      "Marca" => $libro->getMarca(),
                      "Modelo" => $libro->getModelo(),
                      "Especificaciones" => $libro->getEspecificaciones(),
                      "Accesorios" => $libro->getAccesorios(),
                      "Estado" => $libro->getEstado()
                    ]);
                }
                return $R;
              }
          ],
          'Tabladibujos' => [
              'type' => Type::listOf($Tabladibujo),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Codigo' => ['type' => Type::string()],
                  'Marca' => ['type' => Type::string()],
                  'Especificaciones' => ['type' => Type::string()],
                  'Estado' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $libros = LibroQuery::create();
                if(isset($args['Id'])) {$libros->filterById($args['Id']);}
                if(isset($args['Codigo'])) {$libros->filterByCodigo($args['Codigo']);}
                if(isset($args['Marca'])) {$libros->filterByMarca($args['Marca']);}
                if(isset($args['Especificaciones'])) {$libros->filterByEspecificaciones($args['Especificaciones']);}
                if(isset($args['Estado'])) {$libros->filterByEstado($args['Estado']);}
                $libros->find();

                $R = [];

                foreach ($libros as $libro) {
                    $R[] = new GQLibro([
                      'Id' => $libro->getId(),
                      "Codigo" => $libro->getCodigo(),
                      "Marca" => $libro->getMarca(),
                      "Especificaciones" => $libro->getEspecificaciones(),
                      "Estado" => $libro->getEstado()
                    ]);
                }
                return $R;
              }
          ],
      ],
  ]);

  $mutationType = new ObjectType([
      'name' => 'Mutation',
      'fields' => [
          'CreateUsuario' => [
            'type' => $Usuario,
            'args' => [
              'UserName' => ['type' => Type::string()],
              'Password' => ['type' => Type::string()],
              'Cedula' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Apellido' => ['type' => Type::string()],
              'Ocupacion' => ['type' => Type::string()],
              'Email' => ['type' => Type::string()],
              'Direccion' => ['type' => Type::string()],
              'Telefono' => ['type' => Type::string()],
              'Activo' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $usuario = UsuarioQuery::create()->filterByCedula($args['Cedula'])->findOne();

              if(is_null($usuario)) {

                $usuario = new Usuario();
                $usuario->setUserName($args['UserName']);
                $usuario->setPassword($args['Password']);
                $usuario->setCedula($args['Cedula']);
                $usuario->setNombre($args['Nombre']);
                $usuario->setApellido($args['Apellido']);
                $usuario->setOcupacion($args['Ocupacion']);
                $usuario->setEmail($args['Email']);
                $usuario->setDireccion($args['Direccion']);
                $usuario->setTelefono($args['Telefono']);
                $usuario->setActivo($args['Activo']);
                $usuario->save();

                $usuario = UsuarioQuery::create()->filterByCedula($args['Cedula'])->findOne();

                $R = new GQUsuario([
                  'Id' => $usuario->getId(),
                  "UserName" => $usuario->getUserName(),
                  "Password" => $usuario->getPassword(),
                  "Cedula" => $usuario->getCedula(),
                  "Nombre" => $usuario->getNombre(),
                  'Apellido' => $usuario->getApellido(),
                  'Ocupacion' => $usuario->getOcupacion(),
                  'Email' => $usuario->getEmail(),
                  'Direccion' => $usuario->getDireccion(),
                  'Telefono' => $usuario->getTelefono(),
                  'Activo' => $usuario->getActivo()
                ]);
                return $R;

              } else {
                $R = new GQUsuario([
                  'Id' => null,
                  "UserName" => null,
                  "Password" => null,
                  "Cedula" => null,
                  "Nombre" => null,
                  'Apellido' => null,
                  'Ocupacion' => null,
                  'Email' => null,
                  'Direccion' => null,
                  'Telefono' => null,
                  'Activo' => null
                ]);;
                return $R;
              }
            }
          ],
          'UpdateUsuario' => [
            'type' => $Usuario,
            'args' => [
              'Id' => ['type' => Type::int()],
              'UserName' => ['type' => Type::string()],
              'Password' => ['type' => Type::string()],
              'Cedula' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Apellido' => ['type' => Type::string()],
              'Ocupacion' => ['type' => Type::string()],
              'Email' => ['type' => Type::string()],
              'Direccion' => ['type' => Type::string()],
              'Telefono' => ['type' => Type::string()],
              'Activo' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $usuario = UsuarioQuery::create()->filterById($args['Id'])->findOne();

              if($usuario){
                if(isset($args['UserName'])) {$usuario->setUserName($args['UserName']);}
                if(isset($args['Password'])) {$usuario->setPassword($args['Password']);}
                if(isset($args['Cedula'])) {$usuario->setCedula($args['Cedula']);}
                if(isset($args['Nombre'])) {$usuario->setNombre($args['Nombre']);}
                if(isset($args['Apellido'])) {$usuario->setApellido($args['Apellido']);}
                if(isset($args['Ocupacion'])) {$usuario->setOcupacion($args['Ocupacion']);}
                if(isset($args['Email'])) {$usuario->setEmail($args['Email']);}
                if(isset($args['Direccion'])) {$usuario->setDireccion($args['Direccion']);}
                if(isset($args['Telefono'])) {$usuario->setTelefono($args['Telefono']);}
                if(isset($args['Activo'])) {$usuario->setActivo($args['Activo']);}
                $usuario->save();

                $R = new GQUsuario([
                  'Id' => $usuario->getId(),
                  "UserName" => $usuario->getUserName(),
                  "Password" => $usuario->getPassword(),
                  "Cedula" => $usuario->getCedula(),
                  "Nombre" => $usuario->getNombre(),
                  'Apellido' => $usuario->getApellido(),
                  'Ocupacion' => $usuario->getOcupacion(),
                  'Email' => $usuario->getEmail(),
                  'Direccion' => $usuario->getDireccion(),
                  'Telefono' => $usuario->getTelefono(),
                  'Activo' => $usuario->getActivo()
                ]);
                return $R;

              } else {
                $R = new GQUsuario([
                  'Id' => null,
                  "UserName" => null,
                  "Password" => null,
                  "Cedula" => null,
                  "Nombre" => null,
                  'Apellido' => null,
                  'Ocupacion' => null,
                  'Email' => null,
                  'Direccion' => null,
                  'Telefono' => null,
                  'Activo' => null
                ]);;
                return $R;
              }
            }
          ],
          'CreateGrupo' => [
            'type' => $Grupo,
            'args' => [
              'Nombre' => ['type' => Type::string()],
            ],
            'resolve' => function ($root, $args) {
              $grupo = GrupoQuery::create()->filterByNombre($args['Nombre'])->findOne();

              if(is_null($grupo)) {

                $grupo = new Grupo();
                $grupo->setNombre($args['Nombre']);
                $grupo->save();

                $grupo = GrupoQuery::create()->filterByNombre($args['Nombre'])->findOne();

                $R = new GQGrupo([
                  'Id' => $grupo->getId(),
                  "Nombre" => $grupo->getNombre()
                ]);
                return $R;

              } else {
                $R = new GQGrupo([
                  'Id' => null,
                  "Nombre" => null
                ]);
                return $R;
              }
            }
          ],
          'UpdateGrupo' => [
            'type' => $Usuario,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Nombre' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $grupo = GrupoQuery::create()->filterById($args['Id'])->findOne();

              if($grupo){
                if(isset($args['Nombre'])) {$grupo->setNombre($args['Nombre']);}
                $grupo->save();

                $R = new GQGrupo([
                  'Id' => $grupo->getId(),
                  "Nombre" => $grupo->getNombre()
                ]);
                return $R;

              } else {
                $R = new GQGrupo([
                  'Id' => null,
                  "Nombre" => null
                ]);
                return $R;
              }
            }
          ],
          'UsuarioAddGrupo' => [
            'type' => $Usuario,
            'args' => [
              'UsuarioId' => ['type' => Type::int()],
              'GrupoId' => ['type' => Type::int()]
            ],
            'resolve' => function ($root, $args) {
              $usuario = UsuarioQuery::create()->filterById($args['UsuarioId'])->findOne();
              $grupo = GrupoQuery::create()->filterById($args['GrupoId'])->findOne();

              if(isset($usuario) && isset($grupo)) {
                $usuario->addGrupo($grupo);
                $usuario->save();
              }

              $G = [];
              $grupos = $usuario->getGrupos();

              foreach ($grupos as $grupo) {
                $G[] = new GQGrupo([
                  'Id' => $grupo->getId(),
                  'Nombre' => $grupo->getNombre()
                ]);
              }

              $R = new GQUsuario([
                'Id' => $usuario->getId(),
                "UserName" => $usuario->getUserName(),
                "Password" => $usuario->getPassword(),
                "Cedula" => $usuario->getCedula(),
                "Nombre" => $usuario->getNombre(),
                'Apellido' => $usuario->getApellido(),
                'Ocupacion' => $usuario->getOcupacion(),
                'Email' => $usuario->getEmail(),
                'Direccion' => $usuario->getDireccion(),
                'Telefono' => $usuario->getTelefono(),
                'Activo' => $usuario->getActivo(),
                'Grupos' => $G
              ]);

            return $R;

            }
          ],
          'UsuarioRemoveGrupo' => [
            'type' => $Usuario,
            'args' => [
              'UsuarioId' => ['type' => Type::int()],
              'GrupoId' => ['type' => Type::int()]
            ],
            'resolve' => function ($root, $args) {
              $usuario = UsuarioQuery::create()->filterById($args['UsuarioId'])->findOne();
              $grupo = GrupoQuery::create()->filterById($args['GrupoId'])->findOne();

              if(isset($usuario) && isset($grupo)) {
                $usuario->removeGrupo($grupo);
                $usuario->save();
              }

              $G = [];
              $grupos = $usuario->getGrupos();

              foreach ($grupos as $grupo) {
                $G[] = new GQGrupo([
                  'Id' => $grupo->getId(),
                  'Nombre' => $grupo->getNombre()
                ]);
              }

              $R = new GQUsuario([
                'Id' => $usuario->getId(),
                "UserName" => $usuario->getUserName(),
                "Password" => $usuario->getPassword(),
                "Cedula" => $usuario->getCedula(),
                "Nombre" => $usuario->getNombre(),
                'Apellido' => $usuario->getApellido(),
                'Ocupacion' => $usuario->getOcupacion(),
                'Email' => $usuario->getEmail(),
                'Direccion' => $usuario->getDireccion(),
                'Telefono' => $usuario->getTelefono(),
                'Activo' => $usuario->getActivo(),
                'Grupos' => $G
              ]);

            return $R;

            }
          ],
          'CreateLibro' => [
            'type' => $Libro,
            'args' => [
              'Categoria' => ['type' => Type::string()],
              'Isbn' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Editorial' => ['type' => Type::string()],
              'Edicion' => ['type' => Type::string()],
              'Fecha' => ['type' => Type::string()],
              'Lugar' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $libro = LibroQuery::create()->filterByIsbn($args['Isbn'])->findOne();

              if(is_null($libro)) {

                $libro = new Libro();
                $libro->setCategoria($args['Categoria']);
                $libro->setIsbn($args['Isbn']);
                $libro->setNombre($args['Nombre']);
                $libro->setEditorial($args['Editorial']);
                $libro->setEdicion($args['Edicion']);
                $libro->setFecha($args['Fecha']);
                $libro->setLugar($args['Lugar']);
                $libro->setEstado($args['Estado']);
                $libro->save();

                $libro = LibroQuery::create()->filterByIsbn($args['Isbn'])->findOne();

                $R = new GQLibro([
                  'Id' => $libro->getId(),
                  "Categoria" => $libro->getCategoria(),
                  "Isbn" => $libro->getIsbn(),
                  "Nombre" => $libro->getNombre(),
                  "Editorial" => $libro->getEditorial(),
                  "Edicion" => $libro->getEdicion(),
                  "Fecha" => $libro->getFecha()->format('Y-m-d'),
                  "Lugar" => $libro->getLugar(),
                  "Estado" => $libro->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQLibro([
                  'Id' => null,
                  "Categoria" => null,
                  "Isbn" => null,
                  "Nombre" => null,
                  "Editorial" => null,
                  "Edicion" => null,
                  "Fecha" => null,
                  "Lugar" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
          'UpdateLibro' => [
            'type' => $Libro,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Categoria' => ['type' => Type::string()],
              'Isbn' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Editorial' => ['type' => Type::string()],
              'Edicion' => ['type' => Type::string()],
              'Fecha' => ['type' => Type::string()],
              'Lugar' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $libro = LibroQuery::create()->filterByIsbn($args['Isbn'])->findOne();

              if($libro){
                if(isset($args['Categoria'])) {$libro->setCategoria($args['Categoria']);}
                if(isset($args['Nombre'])) {$libro->setNombre($args['Nombre']);}
                if(isset($args['Editorial'])) {$libro->setEditorial($args['Editorial']);}
                if(isset($args['Edicion'])) {$libro->setEdicion($args['Edicion']);}
                if(isset($args['Fecha'])) {$libro->setFecha($args['Fecha']);}
                if(isset($args['Lugar'])) {$libro->setLugar($args['Lugar']);}
                if(isset($args['Estado'])) {$libro->setEstado($args['Estado']);}
                $libro->save();

                $R = new GQLibro([
                  'Id' => $libro->getId(),
                  "Categoria" => $libro->getCategoria(),
                  "Isbn" => $libro->getIsbn(),
                  "Nombre" => $libro->getNombre(),
                  "Editorial" => $libro->getEditorial(),
                  "Edicion" => $libro->getEdicion(),
                  "Fecha" => $libro->getFecha()->format('Y-m-d'),
                  "Lugar" => $libro->getLugar(),
                  "Estado" => $libro->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQLibro([
                  'Id' => null,
                  "Categoria" => null,
                  "Isbn" => null,
                  "Nombre" => null,
                  "Editorial" => null,
                  "Edicion" => null,
                  "Fecha" => null,
                  "Lugar" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
          'CreateVideobean' => [
            'type' => $Videobean,
            'args' => [
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Modelo' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Accesorios' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $videobean = VideobeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if(is_null($videobean)) {

                $videobean = new Videobean();
                $videobean->setCodigo($args['Codigo']);
                $videobean->setMarca($args['Marca']);
                $videobean->setModelo($args['Modelo']);
                $videobean->setEspecificaciones($args['Especificaciones']);
                $videobean->setAccesorios($args['Accesorios']);
                $videobean->setEstado($args['Estado']);
                $videobean->save();

                $videobean = VideobeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

                $R = new GQVidebean([
                  'Id' => $videobean->getId(),
                  "Codigo" => $videobean->getCodigo(),
                  "Marca" => $videobean->getMarca(),
                  "Modelo" => $videobean->getModelo(),
                  "Especificaciones" => $videobean->getEspecificaciones(),
                  "Accesorios" => $videobean->getAccesorios(),
                  "Estado" => $videobean->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQVidebean([
                  'Id' => null,
                  "Codigo" => null,
                  "Marca" => null,
                  "Modelo" => null,
                  "Especificaciones" => null,
                  "Accesorios" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
          'UpdateVideobean' => [
            'type' => $Videobean,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Modelo' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Accesorios' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $videobean = VideobeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if($videobean){
                if(isset($args['Marca'])) {$videobean->setMarca($args['Marca']);}
                if(isset($args['Modelo'])) {$videobean->setModelo($args['Modelo']);}
                if(isset($args['Especificaciones'])) {$videobean->setEspecificaciones($args['Especificaciones']);}
                if(isset($args['Accesorios'])) {$videobean->setAccesorios($args['Accesorios']);}
                if(isset($args['Estado'])) {$videobean->setEstado($args['Estado']);}
                $videobean->save();

                $R = new GQVideobean([
                  'Id' => $videobean->getId(),
                  "Codigo" => $videobean->getCodigo(),
                  "Marca" => $videobean->getMarca(),
                  "Modelo" => $videobean->getModelo(),
                  "Especificaciones" => $videobean->getEspecificaciones(),
                  "Accesorios" => $videobean->getAccesorios(),
                  "Estado" => $videobean->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQVideobean([
                  'Id' => null,
                  "Codigo" => null,
                  "Marca" => null,
                  "Modelo" => null,
                  "Especificaciones" => null,
                  "Accesorios" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
          'CreateTabladibujo' => [
            'type' => $Videobean,
            'args' => [
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $tabladibujo = TabladibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if(is_null($tabladibujo)) {

                $tabladibujo = new Tabladibujo();
                $tabladibujo->setCodigo($args['Codigo']);
                $tabladibujo->setMarca($args['Marca']);
                $tabladibujo->setEspecificaciones($args['Especificaciones']);
                $tabladibujo->setEstado($args['Estado']);
                $tabladibujo->save();

                $tabladibujo = TabladibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

                $R = new GQTabladibujo([
                  'Id' => $tabladibujo->getId(),
                  "Codigo" => $tabladibujo->getCodigo(),
                  "Marca" => $tabladibujo->getMarca(),
                  "Especificaciones" => $tabladibujo->getEspecificaciones(),
                  "Estado" => $tabladibujo->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQLibro([
                  'Id' => null,
                  "Codigo" => null,
                  "Marca" => null,
                  "Especificaciones" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
          'UpdateTabladibujo' => [
            'type' => $Tabladibujo,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $tabladibujo = TabladibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if($tabladibujo){
                if(isset($args['Marca'])) {$tabladibujo->setMarca($args['Marca']);}
                if(isset($args['Especificaciones'])) {$tabladibujo->setEspecificaciones($args['Especificaciones']);}
                if(isset($args['Estado'])) {$tabladibujo->setEstado($args['Estado']);}
                $tabladibujo->save();

                $R = new GQVideobean([
                  'Id' => $tabladibujo->getId(),
                  "Codigo" => $tabladibujo->getCodigo(),
                  "Marca" => $tabladibujo->getMarca(),
                  "Especificaciones" => $tabladibujo->getEspecificaciones(),
                  "Estado" => $tabladibujo->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQVideobean([
                  'Id' => null,
                  "Codigo" => null,
                  "Marca" => null,
                  "Especificaciones" => null,
                  "Estado" => null
                ]);
                return $R;
              }
            }
          ],
      ],
  ]);
  // See docs on schema options:
  // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
  $schema = new Schema([
      'query' => $queryType,
      'mutation' => $mutationType
  ]);

  $server = new StandardServer([
    'queryBatching' => true,
    'schema' => $schema

  ]);

  $server->handleRequest();

} catch (\Exception $e) {

  print $e->getMessage();
  StandardServer::send500Error($e);

}
