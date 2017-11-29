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

class GQVideoBean {
  public $Id;
  public $Codigo;
  public $Marca;
  public $Modelo;
  public $Especificaciones;
  public $Accesorios;
  public $Estado;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQTablaDibujo {
  public $Id;
  public $Codigo;
  public $Marca;
  public $Especificaciones;
  public $Estado;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

Class GQPrestamo {
  public $Id;
  public $UsuarioId;
  public $LibroId;
  public $VideoBeanId;
  public $TablaDibujoId;
  public $FechaReserva;
  public $FechaPrestamo;
  public $FechaDevolucion;
  public $Estado;
  public $Sancion;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

try {
  //Tipo de objeto Usuario
  $GrupoHQL = new ObjectType([
    'name' => 'Grupo',
    'description' => 'Objeto que describe un grupo',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Nombre' => ['type' => Type::string()]
    ]
  ]);

  $UsuarioHQL = new ObjectType([
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
        'Grupos' => ['type' => Type::listOf($GrupoHQL)]
    ]
  ]);

  $LibroHQL = new ObjectType([
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


  $VideoBeanHQL = new ObjectType([
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

  $TablaDibujoHQL = new ObjectType([
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

  $PrestamoHQL = new ObjectType([
    'name' => 'Prestamo',
    'description' => 'Objeto que describe un prestamo',
    'fields' => [
      'Id' => ['type' => Type::int()],
      'UsuarioId' => ['type' => Type::int()],
      'LibroId' => ['type' => Type::int()],
      'VideoBeanId' => ['type' => Type::int()],
      'TablaDibujoId' => ['type' => Type::int()],
      'FechaReserva' => ['type' => Type::string()],
      'FechaPrestamo' => ['type' => Type::string()],
      'FechaDevolucion' => ['type' => Type::string()],
      'Estado' => ['type' => Type::string()],
      'Sancion' => ['type' => Type::float()]
    ]
  ]);


  //Tipo de objeto Query
  $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
          'Usuarios' => [
              'type' => Type::listOf($UsuarioHQL),
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
              'type' => Type::listOf($GrupoHQL),
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
              'type' => Type::listOf($LibroHQL),
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
          'VideoBeans' => [
              'type' => Type::listOf($VideoBeanHQL),
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
                $videobeans = VideoBeanQuery::create();
                if(isset($args['Id'])) {$videobeans->filterById($args['Id']);}
                if(isset($args['Codigo'])) {$videobeans->filterByCodigo($args['Codigo']);}
                if(isset($args['Marca'])) {$videobeans->filterByMarca($args['Marca']);}
                if(isset($args['Modelo'])) {$videobeans->filterByModelo($args['Modelo']);}
                if(isset($args['Especificaciones'])) {$videobeans->filterByEspecificaciones($args['Especificaciones']);}
                if(isset($args['Accesorios'])) {$videobeans->filterByAccesorios($args['Accesorios']);}
                if(isset($args['Estado'])) {$videobeans->filterByEstado($args['Estado']);}
                $videobeans->find();

                $R = [];

                foreach ($videobeans as $videobean) {
                    $R[] = new GQVideoBean([
                      'Id' => $videobean->getId(),
                      "Codigo" => $videobean->getCodigo(),
                      "Marca" => $videobean->getMarca(),
                      "Modelo" => $videobean->getModelo(),
                      "Especificaciones" => $videobean->getEspecificaciones(),
                      "Accesorios" => $videobean->getAccesorios(),
                      "Estado" => $videobean->getEstado()
                    ]);
                }
                return $R;
              }
          ],
          'TablaDibujos' => [
              'type' => Type::listOf($TablaDibujoHQL),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Codigo' => ['type' => Type::string()],
                  'Marca' => ['type' => Type::string()],
                  'Especificaciones' => ['type' => Type::string()],
                  'Estado' => ['type' => Type::string()]
              ],
              'resolve' => function ($db, $args) {
                $tabladibujos = TablaDibujoQuery::create();
                if(isset($args['Id'])) {$tabladibujos->filterById($args['Id']);}
                if(isset($args['Codigo'])) {$tabladibujos->filterByCodigo($args['Codigo']);}
                if(isset($args['Marca'])) {$tabladibujos->filterByMarca($args['Marca']);}
                if(isset($args['Especificaciones'])) {$tabladibujos->filterByEspecificaciones($args['Especificaciones']);}
                if(isset($args['Estado'])) {$tabladibujos->filterByEstado($args['Estado']);}
                $tabladibujos->find();

                $R = [];

                foreach ($tabladibujos as $tabladibujo) {
                    $R[] = new GQTablaDibujo([
                      'Id' => $tabladibujo->getId(),
                      "Codigo" => $tabladibujo->getCodigo(),
                      "Marca" => $tabladibujo->getMarca(),
                      "Especificaciones" => $tabladibujo->getEspecificaciones(),
                      "Estado" => $tabladibujo->getEstado()
                    ]);
                }
                return $R;
              }
          ],
          'Prestamos' => [
              'type' => Type::listOf($PrestamoHQL),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'UsuarioId' => ['type' => Type::int()],
                  'LibroId' => ['type' => Type::int()],
                  'VideoBeanId' => ['type' => Type::int()],
                  'TablaDibujoId' => ['type' => Type::int()],
                  'FechaReserva' => ['type' => Type::string()],
                  'FechaPrestamo' => ['type' => Type::string()],
                  'FechaDevolucion' => ['type' => Type::string()],
                  'Estado' => ['type' => Type::string()],
                  'Sancion' => ['type' => Type::float()],
              ],
              'resolve' => function ($db, $args) {
                $prestamos = PrestamoQuery::create();
                if(isset($args['Id'])) {$prestamos->filterById($args['Id']);}
                if(isset($args['UsuarioId'])) {$prestamos->filterByUsuarioId($args['UsuarioId']);}
                if(isset($args['LibroId'])) {$prestamos->filterByLibroId($args['LibroId']);}
                if(isset($args['VideoBeanId'])) {$prestamos->filterByVideoBeanId($args['VideBeanId']);}
                if(isset($args['TablaDibujoId'])) {$prestamos->filterByTablaDibujoId($args['TablaDibujoId']);}
                if(isset($args['FechaReserva'])) {$prestamos->filterByFechaReserva($args['FechaReserva']);}
                if(isset($args['FechaPrestamo'])) {$prestamos->filterByFechaPrestamo($args['FechaPrestamo']);}
                if(isset($args['FechaDevolucion'])) {$prestamos->filterByFechaDevolucion($args['FechaDevolucion']);}
                if(isset($args['Estado'])) {$prestamos->filterByEstado($args['Estado']);}
                if(isset($args['Sancion'])) {$prestamos->filterBySancion($args['Sancion']);}
                $prestamos->find();

                $R = [];

                foreach ($prestamos as $prestamo) {
                    $R[] = new GQPrestamo([
                      "Id" => $prestamo->getId(),
                      "UsuarioId" => $prestamo->getUsuarioId(),
                      "LibroId" => $prestamo->getLibroId(),
                      "VideoBeanId" => $prestamo->getVideoBeanId(),
                      "TablaDibujoId" => $prestamo->getTablaDibujoId(),
                      "FechaReserva" => $prestamo->getFechaReserva()->format('Y-m-d'),
                      "FechaPrestamo" => $prestamo->getFechaPrestamo()->format('Y-m-d'),
                      "FechaDevolucion" => $prestamo->getFechaDevolucion()->format('Y-m-d'),
                      "Estado" => $prestamo->getEstado(),
                      "Sancion" => $prestamo->getSancion()
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
            'type' => $UsuarioHQL,
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
            'type' => $UsuarioHQL,
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
            'type' => $GrupoHQL,
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
            'type' => $UsuarioHQL,
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
            'type' => $UsuarioHQL,
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
            'type' => $UsuarioHQL,
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
            'type' => $LibroHQL,
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
            'type' => $LibroHQL,
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
          'CreateVideoBean' => [
            'type' => $VideoBeanHQL,
            'args' => [
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Modelo' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Accesorios' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $videobean = VideoBeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if(is_null($videobean)) {

                $videobean = new VideoBean();
                $videobean->setCodigo($args['Codigo']);
                $videobean->setMarca($args['Marca']);
                $videobean->setModelo($args['Modelo']);
                $videobean->setEspecificaciones($args['Especificaciones']);
                $videobean->setAccesorios($args['Accesorios']);
                $videobean->setEstado($args['Estado']);
                $videobean->save();

                $videobean = VideoBeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

                $R = new GQVideoBean([
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
                $R = new GQVideoBean([
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
          'UpdateVideoBean' => [
            'type' => $VideoBeanHQL,
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
              $videobean = VideoBeanQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if($videobean){
                if(isset($args['Marca'])) {$videobean->setMarca($args['Marca']);}
                if(isset($args['Modelo'])) {$videobean->setModelo($args['Modelo']);}
                if(isset($args['Especificaciones'])) {$videobean->setEspecificaciones($args['Especificaciones']);}
                if(isset($args['Accesorios'])) {$videobean->setAccesorios($args['Accesorios']);}
                if(isset($args['Estado'])) {$videobean->setEstado($args['Estado']);}
                $videobean->save();

                $R = new GQVideoBean([
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
                $R = new GQVideoBean([
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
          'CreateTablaDibujo' => [
            'type' => $TablaDibujoHQL,
            'args' => [
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $tabladibujo = TablaDibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if(is_null($tabladibujo)) {

                $tabladibujo = new TablaDibujo();
                $tabladibujo->setCodigo($args['Codigo']);
                $tabladibujo->setMarca($args['Marca']);
                $tabladibujo->setEspecificaciones($args['Especificaciones']);
                $tabladibujo->setEstado($args['Estado']);
                $tabladibujo->save();

                $tabladibujo = TablaDibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

                $R = new GQTablaDibujo([
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
          'UpdateTablaDibujo' => [
            'type' => $TablaDibujoHQL,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Codigo' => ['type' => Type::string()],
              'Marca' => ['type' => Type::string()],
              'Especificaciones' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()]
            ],
            'resolve' => function ($root, $args) {
              $tabladibujo = TablaDibujoQuery::create()->filterByCodigo($args['Codigo'])->findOne();

              if($tabladibujo){
                if(isset($args['Marca'])) {$tabladibujo->setMarca($args['Marca']);}
                if(isset($args['Especificaciones'])) {$tabladibujo->setEspecificaciones($args['Especificaciones']);}
                if(isset($args['Estado'])) {$tabladibujo->setEstado($args['Estado']);}
                $tabladibujo->save();

                $R = new GQTablaDibujo([
                  'Id' => $tabladibujo->getId(),
                  "Codigo" => $tabladibujo->getCodigo(),
                  "Marca" => $tabladibujo->getMarca(),
                  "Especificaciones" => $tabladibujo->getEspecificaciones(),
                  "Estado" => $tabladibujo->getEstado()
                ]);
                return $R;

              } else {
                $R = new GQTablaDibujo([
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
          'CreatePrestamo' => [
            'type' => $PrestamoHQL,
            'args' => [
              'UsuarioId' => ['type' => Type::int()],
              'LibroId' => ['type' => Type::int()],
              'VideoBeanId' => ['type' => Type::int()],
              'TablaDibujoId' => ['type' => Type::int()],
              'FechaReserva' => ['type' => Type::string()],
              'FechaPrestamo' => ['type' => Type::string()],
              'FechaDevolucion' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()],
              'Sancion' => ['type' => Type::float()]
            ],
            'resolve' => function ($root, $args) {
              $prestamo = PrestamoQuery::create();
              $prestamo->filterByUsuarioId($args['UsuarioId']);
              if(isset($args['LibroId'])) {$prestamo->filterByLibroId($args['LibroId']);}
              if(isset($args['VideoBeanId'])) {$prestamo->filterByVideoBeanId($args['VideoBeanId']);}
              if(isset($args['TablaDibujoId'])) {$prestamo->filterByTablaDibujoId($args['TablaDibujoId']);}
              $prestamo->filterByFechaReserva($args['FechaReserva']);
              $prestamo->findOne();

              if(is_null($prestamo)) {
                $prestamo = new Prestamo();
                $prestamo->setUsuarioId($args['UsuarioId']);
                if(isset($args['LibroId'])) {$prestamo->setLibroId($args['LibroId']);}
                if(isset($args['VideoBeanId'])) {$prestamo->setVideoBeanId($args['VideoBeanId']);}
                if(isset($args['TablaDibujoId'])) {$prestamo->setTablaDibujoId($args['TablaDibujoId']);}
                $prestamo->setFechaReserva($args['FechaReserva']);
                $prestamo->setEstado('Reservado');
                $prestamo->save();

                $prestamo = PrestamoQuery::create();
                $prestamo->filterByUsuarioId($args['UsuarioId']);
                if(isset($args['LibroId'])) {$prestamo->filterByLibroId($args['LibroId']);}
                if(isset($args['VideoBeanId'])) {$prestamo->filterByVideoBeanId($args['VideoBeanId']);}
                if(isset($args['TablaDibujoId'])) {$prestamo->filterByTablaDibujoId($args['TablaDibujoId']);}
                $prestamo->filterByFechaReserva($args['FechaReserva']);
                $prestamo->findOne();

                $R = new GQPrestamo([
                  'Id' => $prestamo->getId(),
                  "UsuarioId" => $prestamo->getUsuarioId(),
                  "LibroId" => $prestamo->getLibroId(),
                  "VideoBeanId" => $prestamo->getVideoBeanId(),
                  "TablaDibujoId" => $prestamo->getTablaDibujoId(),
                  "FechaReserva" => $prestamo->getFechaReserva(),
                  "FechaPrestamo" => $prestamo->getFechaPrestamo(),
                  "FechaDevolucion" => $prestamo->getFechaDevolucion(),
                  "Estado" => $prestamo->getEstado(),
                  "Sancion" => $prestamo->getSancion()
                ]);
                return $R;

              } else {
                $R = new GQPrestamo([
                  'Id' => null,
                  "UsuarioId" => null,
                  "LibroId" => null,
                  "VideoBeanId" => null,
                  "TablaDibujoId" => null,
                  "FechaReserva" => null,
                  "FechaPrestamo" => null,
                  "FechaDevolucion" => null,
                  "Estado" => null,
                  "Sancion" => null
                ]);
                return $R;
              }
            }
          ],
          'UpdatePrestamo' => [
            'type' => $TablaDibujoHQL,
            'args' => [
              'Id' => ['type' => Type::int()],
              'UsuarioId' => ['type' => Type::int()],
              'LibroId' => ['type' => Type::int()],
              'VideoBeanId' => ['type' => Type::int()],
              'TablaDibujoId' => ['type' => Type::int()],
              'FechaReserva' => ['type' => Type::string()],
              'FechaPrestamo' => ['type' => Type::string()],
              'FechaDevolucion' => ['type' => Type::string()],
              'Estado' => ['type' => Type::string()],
              'Sancion' => ['type' => Type::float()]
            ],
            'resolve' => function ($root, $args) {
              $prestamo = PrestamoQuery::create()->filterById($args['Id'])->findOne();

              if($prestamo){
                if(isset($args['FechaPrestamo'])) {$prestamo->setFechaPrestamo($args['FechaPrestamo']);}
                if(isset($args['FechaDevolucion'])) {$tabladibujo->setFechaDevolucion($args['FechaDevolucion']);}
                if(isset($args['Estado'])) {$tabladibujo->setEstado($args['Estado']);}
                if(isset($args['Sancion'])) {$tabladibujo->setEstado($args['Sancion']);}
                $prestamo->save();

                $R = new GQPrestamo([
                  "Id" => $prestamo->getId(),
                  "UsuarioId" => $prestamo->getUsuarioId(),
                  "LibroId" => $prestamo->getLibroId(),
                  "VideoBeanId" => $prestamo->getVideoBeanId(),
                  "TablaDibujoId" => $prestamo->getTablaDibujoId(),
                  "FechaReserva" => $prestamo->getFechaReserva(),
                  "FechaPrestamo" => $prestamo->getFechaPrestamo(),
                  "FechaDevolucion" => $prestamo->getFechaDevolucion(),
                  "Estado" => $prestamo->getEstado(),
                  "Sancion" => $prestamo->getSancion()
                ]);
                return $R;

              } else {
                $R = new GQPrestamo([
                  "Id" => null,
                  "UsuarioId" => null,
                  "LibroId" => null,
                  "VideoBeanId" => null,
                  "TablaDibujoId" => null,
                  "FechaReserva" => null,
                  "FechaPrestamo" => null,
                  "FechaDevolucion" => null,
                  "Estado" => null,
                  "Sancion" => null
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
