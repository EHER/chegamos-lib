# Chegamos-lib [![Build Status](https://secure.travis-ci.org/EHER/chegamos-lib.png)](http://travis-ci.org/EHER/chegamos-lib)
Utilize o make para interagir com o projeto.


## Exemplos

Os exemplos esperam que você tenha um Autoloader configurado e que tenha suas chaves de acesso à API.

### Todos os exemplos devem começar com:

    <?php

    use chegamos\rest\Curl as RestClient;
    use chegamos\entity\repository\UserRepository;

    // AutoLoader

    $key = "MinhaConsumerKey";
    $secret = "MinhaConsumerSecret";

    $restClient = new RestClient("http://api.apontador.com.br/v1/");
    $restClient->setAuth($key, $secret);

    $userRepository = new UserRepository($restClient);

### Pegar dados de um usuário:

    $user = $userRepository->get("8972911185");
    var_dump($user);

### Pegar dados de um usuário com as avaliações:

    $user = $userRepository->byId("8972911185")
    ->withReviews()
    ->get();
    var_dump($user);

### Pegar dados de um usuário com a segunda página de avaliações:

    $user = $userRepository->byId("8972911185")
    ->withReviews()
    ->page(2)
    ->get();
    var_dump($user);

### Buscar usuário por nome

    $userList = $userRepository->byName("Eher")
    ->getAll();
    var_dump($userList);

### Buscar usuário por email

    $userList = $userRepository->byEmail("alexandre@eher.com.br")
    ->getAll();
    var_dump($userList);

