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
