<?php
// Test this using following command
// php -S localhost:8080 ./graphql.php &
// curl http://localhost:8080 -d '{"query": "query { echo(message: \"Hello World\") }" }'
// curl http://localhost:8080 -d '{"query": "mutation { sum(x: 2, y: 2) }" }'
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated-conf/config.php';

$entityBody = file_get_contents('php://input');
$obj = json_decode($entityBody);

$usuario = UsuarioQuery::create()->filterByUserName($obj->UserName)->findOne();

if(!is_null($usuario)) {

  echo json_encode([
    'Result' => 1,
    'Id' => $usuario->getId(),
    'UserName' => $usuario->getUserName(),
    'Password' => $usuario->getPassword(),
    'PlainPassword' => $obj->Password
  ]);

} else {

  echo json_encode(['Result'=>0]);

}
