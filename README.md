# Chegamos-lib [![Build Status](https://secure.travis-ci.org/EHER/chegamos-lib.png)](http://travis-ci.org/EHER/chegamos-lib)
Utilize o make para interagir com o projeto.


## Exemplos

Os exemplos esperam que você tenha um Autoloader configurado e que tenha suas chaves de acesso à API.

### Todos os exemplos devem começar com:

    <?php

    use chegamos\rest\Curl as RestClient;
    use chegamos\entity\repository\UserRepository;
    use chegamos\entity\repository\PlaceRepository;

    $key = "MinhaConsumerKey";
    $secret = "MinhaConsumerSecret";

    $restClient = new RestClient("http://api.apontador.com.br/v1/");
    $restClient->setAuth($key, $secret);

### Repositório de locais

    $placeRepository = new PlaceRepository($restClient);

#### Pegar dados de um local:

    $place = $placeRepository->get("UCV34B2P");
    var_dump($place);

#### Pegar dados de um usuário com as avaliações:

    $place = $placeRepository->byId("UCV34B2P")
    ->withReviews()
    ->get();
    var_dump($place);

#### Pegar dados de um usuário com as fotos:

    $place = $placeRepository->byId("UCV34B2P")
    ->withPhotos()
    ->get();
    var_dump($place);

### Repositório de usuários

    $userRepository = new UserRepository($restClient);

#### Pegar dados de um usuário:

    $user = $userRepository->get("8972911185");
    var_dump($user);

#### Pegar dados de um usuário com as avaliações:

    $user = $userRepository->byId("8972911185")
    ->withReviews()
    ->get();
    var_dump($user);

#### Pegar dados de um usuário com a segunda página de avaliações:

    $user = $userRepository->byId("8972911185")
    ->withReviews()
    ->page(2)
    ->get();
    var_dump($user);

#### Buscar usuário por nome

    $userList = $userRepository->byName("Eher")
    ->getAll();
    var_dump($userList);

#### Buscar usuário por email

    $userList = $userRepository->byEmail("alexandre@eher.com.br")
    ->getAll();
    var_dump($userList);


## Curl ou Guzzle

O Guzzle é uma forma muito simpática de trabalhar com REST sem ter que lidar
direto com o Curl. Nos exemplos acima, nós usamos o Curl por não depender de 
outro projeto, mas é recomendado usar Guzzle.

Para mudar de Curl para Guzzle basta mudar a linha:

    use chegamos\rest\Curl as RestClient;

para

    use chegamos\rest\Guzzle as RestClient;
