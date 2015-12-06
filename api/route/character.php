<?php

/* Reputation data of a particular person */
$app->get('/character/{id}/', function ($id) use ($app) {
    $dbEngine = $app['config']['dbEngine'];
    $dbClass = '\Mikron\RpgSystem\Infrastructure\Storage\\'
        . $app['config']['databaseReference'][$dbEngine] . 'StorageEngine';
    $connection = new $dbClass($app['config'][$dbEngine]);

    $factory = new \Mikron\RpgSystem\Infrastructure\Factory\Character();

    $person = $factory->retrieveCharacterFromDb($connection,$id);

    $output = new \Mikron\RpgSystem\Domain\Service\Output(
        "Character data",
        "",
        [$person->getName()]
    );

    return $app->json($output->getArrayForJson());
});
