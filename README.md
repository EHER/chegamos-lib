Chegamos-lib [![Build Status](https://secure.travis-ci.org/EHER/chegamos-lib.png)](http://travis-ci.org/EHER/chegamos-lib)
============
Utilize o make para interagir com o projeto.


Exemplo de como pegar dados de um usuário:

use chegamos\rest\Guzzle as RestClient;
use chegamos\entity\repository\UserRepository;

$key = "MinhaConsumerKey";
$secret = "MinhaConsumerSecret";

$restClient = new RestClient("http://api.apontador.com.br/v1/");
$restClient->setAuth($key, $secret);

$userRepository = new UserRepository($restClient);
$user = $userRepository->get("8972911185");

var_dump($user);
