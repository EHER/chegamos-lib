# Chegamos-lib [![Build Status](https://secure.travis-ci.org/EHER/chegamos-lib.png)](http://travis-ci.org/EHER/chegamos-lib)
Utilize o make para interagir com o projeto.


## Exemplos

### Pegar dados de um usuário:

    <?php

    use chegamos\rest\Curl as RestClient;
    use chegamos\entity\repository\UserRepository;

    $key = "MinhaConsumerKey";
    $secret = "MinhaConsumerSecret";

    $restClient = new RestClient("http://api.apontador.com.br/v1/");
    $restClient->setAuth($key, $secret);

    $userRepository = new UserRepository($restClient);
    $user = $userRepository->get("8972911185");
    var_dump($user);

### Pegar dados de um usuário com as avaliações:

    <?php

    use chegamos\rest\Curl as RestClient;
    use chegamos\entity\repository\UserRepository;

    $key = "MinhaConsumerKey";
    $secret = "MinhaConsumerSecret";

    $restClient = new RestClient("http://api.apontador.com.br/v1/");
    $restClient->setAuth($key, $secret);

    $userRepository = new UserRepository($restClient);
    $user = $userRepository->getWithReviews("8972911185");
    var_dump($user);

