# Chegamos-lib [![Build Status](https://secure.travis-ci.org/EHER/chegamos-lib.png?branch=master)](http://travis-ci.org/EHER/chegamos-lib)
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

#### Pegar dados de um local com as avaliações:

    $place = $placeRepository->byId("UCV34B2P")
    ->withReviews()
    ->get();
    var_dump($place);

#### Pegar dados de um local com as fotos:

    $place = $placeRepository->byId("UCV34B2P")
    ->withPhotos()
    ->get();
    var_dump($place);

#### Listar locais perto de um endereço (CEP)

    $places = $placeRepository->byZipcode("18040690")
    ->getAll();
    var_dump($places);

#### Listar locais perto de um endereço (CEP) filtrando por categoria

    $places = $placeRepository->byZipcode("18040690")
    ->withCategoryId("043") // Associacoes E Sindicatos
    ->getAll();
    var_dump($places);

#### Listar locais perto de um endereço (CEP) filtrando por subcategoria

    $places = $placeRepository->byZipcode("18040690")
    ->withSubcategoryId("6661") // Associacoes Beneficentes
    ->getAll();
    var_dump($places);

#### Listar locais perto de um endereço (CEP) filtrando por nome

    $places = $placeRepository->byZipcode("18040690")
    ->withName("Cafe")
    ->getAll();
    var_dump($places);

#### Listar locais de uma cidade (Cidade, UF)

    $city = new City();
    $city->setName("São Paulo");
    $city->setState("SP");

    $address = new Address();
    $address->setCity($city);

    $places = $placeRepository->byAddress($address)
    ->getAll();
    var_dump($places);

#### Listar locais através de coordenadas geográficas

    $point = new Point();
    $point->setLat("-23.51241");
    $point->setLng("-47.46828");

    $places = $placeRepository->byPoint($point)
    ->withName("Cafe")
    ->getAll();
    var_dump($places);


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
