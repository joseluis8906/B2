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
  public $Cedula;
  public $Nombre;
  public $Apellido;
  Public $Activo;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

class GQLibro {
  public $Id;
  public $Isbn;
  public $Editorial;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

try {
  $Usuario = new ObjectType([
    'name' => 'Usuario',
    'description' => 'Objeto que describe un usuario',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Cedula' => ['type' => Type::string()],
        'Nombre' => ['type' => Type::string()],
        'Apellido' => ['type' => Type::string()],
        'Activo' => ['type' => Type::string()],
    ]
  ]);

  $Libro = new ObjectType([
    'name' => 'Libro',
    'description' => 'Objeto que describe un libro',
    'fields' => [
        'Id' => ['type' => Type::int()],
        'Isbn' => ['type' => Type::string()],
        'Editorial' => ['type' => Type::string()],
    ]
  ]);

  $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
          'test' => [
              'type' => Type::string(),
              'args' => [
                  'message' => ['type' => Type::string()],
              ],
              'resolve' => function ($root, $args) {
                  return $root['prefix'] . $args['message'];
              }
          ],
          'Usuarios' => [
              'type' => Type::listOf($Usuario),
              'args' => [
                  'Id' => ['type' => Type::int()],
                  'Cedula' => ['type' => Type::string()],
                  'Nombre' => ['type' => Type::string()],
                  'Apellido' => ['type' => Type::string()],
                  'Activo' => ['type' => Type::string()],
              ],
              'resolve' => function ($db, $args) {
                $usuarios = UsuarioQuery::create();
                if(isset($args['Id'])) {$usuarios->filterById($args['Id']);}
                if(isset($args['Cedula'])) {$usuarios->filterByCedula($args['Cedula']);}
                if(isset($args['Nombre'])) {$usuarios->filterByNombre($args['Nombre']);}
                if(isset($args['Apellido'])) {$usuarios->filterByApellido($args['Apellido']);}
                if(isset($args['Activo'])) {$usuarios->filterByApellido($args['Activo']);}
                $usuarios->find();

                $R = [];

                foreach ($usuarios as $usuario) {
                    $R[] = new GQUsuario([
                      'Id' => $usuario->getId(),
                      "Cedula" => $usuario->getCedula(),
                      "Nombre" => $usuario->getNombre(),
                      'Apellido' => $usuario->getApellido(),
                      'Activo' => $usuario->getActivo(),
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
          'sum' => [
            'type' => Type::int(),
            'args' => [
                'x' => ['type' => Type::int()],
                'y' => ['type' => Type::int()],
            ],
            'resolve' => function ($root, $args) {
                return $args['x'] + $args['y'];
            },
          ],
          'CreateUsuario' => [
            'type' => $Usuario,
            'args' => [
              'Cedula' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Apellido' => ['type' => Type::string()],
              'Activo' => ['type' => Type::string()],
            ],
            'resolve' => function ($root, $args) {
              $usuario = new Usuario();
              $usuario->setCedula($args['Cedula']);
              $usuario->setNombre($args['Nombre']);
              $usuario->setApellido($args['Apellido']);
              $usuario->setActivo($args['Activo']);
              $usuario->save();

              $usuario = UsuarioQuery::create()->filterByCedula($args['Cedula'])->findOne();

              $R = new GQUsuario([
                'Id' => $usuario->getId(),
                "Cedula" => $usuario->getCedula(),
                "Nombre" => $usuario->getNombre(),
                'Apellido' => $usuario->getApellido(),
                'Activo' => $usuario->getActivo(),
              ]);

              return $R;
            }
          ],
          'UpdateUsuario' => [
            'type' => $Usuario,
            'args' => [
              'Id' => ['type' => Type::int()],
              'Cedula' => ['type' => Type::string()],
              'Nombre' => ['type' => Type::string()],
              'Apellido' => ['type' => Type::string()],
              'Activo' => ['type' => Type::string()],
            ],
            'resolve' => function ($root, $args) {
              $usuario = UsuarioQuery::create()->filterById($args['Id'])->findOne();
              if(isset($args['Cedula'])) {$usuario->setCedula($args['Cedula']);}
              if(isset($args['Nombre'])) {$usuario->setNombre($args['Nombre']);}
              if(isset($args['Apellido'])) {$usuario->setApellido($args['Apellido']);}
              if(isset($args['Activo'])) {$usuario->setActivo($args['Activo']);}
              $usuario->save();

              $R = new GQUsuario([
                'Id' => $usuario->getId(),
                "Cedula" => $usuario->getCedula(),
                "Nombre" => $usuario->getNombre(),
                'Apellido' => $usuario->getApellido(),
                'Activo' => $usuario->getActivo(),
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
      'mutation' => $mutationType,
  ]);
  /*$rawInput = file_get_contents('php://input');
  $input = json_decode($rawInput, true);
  $query = $input['query'];
  $variableValues = isset($input['variables']) ? $input['variables'] : null;
  $rootValue = ['prefix' => 'You said: '];
  $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
  $output = $result->toArray();*/
  $server = new StandardServer([
      'schema' => $schema
  ]);

  $server->handleRequest();

} catch (\Exception $e) {
    /*$output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];*/
  print $e->getMessage();
  StandardServer::send500Error($e);
}
/*header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);*/
