<?php
// Test this using following command
// php -S localhost:8080 ./graphql.php &
// curl http://localhost:8080 -d '{"query": "query { echo(message: \"Hello World\") }" }'
// curl http://localhost:8080 -d '{"query": "mutation { sum(x: 2, y: 2) }" }'
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated-conf/config.php';

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use GraphQL\Utils\Utils;

class Usuario {
  public $Codigo;
  public $Nombre;
  public function __construct(array $data)
  {
      Utils::assign($this, $data);
  }
}

try {
    $db = new \PDO( 'sqlite:db/Db.sqlite' );

    $Usuario = new ObjectType([
      'name' => 'Usuario',
      'description' => 'Objeto que describe un usuario',
      'fields' => [
          'Codigo' => [
              'type' => Type::string(),
          ],
          'Nombre' => Type::string()
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
                'type' => $Usuario,
                'args' => [
                    'Codigo' => ['type' => Type::string()],
                    'Nombre' => ['type' => Type::string()],
                ],
                'resolve' => function ($db, $args) {
                  $q = new ProveedorQuery();
                  $firstAuthor = $q->findPK(1);

                  $R = new Usuario([
                    "Codigo" => $firstAuthor->getCodigo(),
                    "Nombre" => $firstAuthor->getNombre(),
                  ]);

                  return $R ;
                }
            ],
        ],
    ]);
    $mutationType = new ObjectType([
        'name' => 'Calc',
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
        ],
    ]);
    // See docs on schema options:
    // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;
    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);
