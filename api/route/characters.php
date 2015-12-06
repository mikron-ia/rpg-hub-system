<?php

/* List of all characters available for display */
$app->get('/characters/', function () use ($app) {
    $dbEngine = $app['config']['dbEngine'];
    $dbClass = '\Mikron\RpgSystem\Infrastructure\Storage\\'
        . $app['config']['databaseReference'][$dbEngine] . 'StorageEngine';
    $connection = new $dbClass($app['config'][$dbEngine]);

    $factory = new \Mikron\RpgSystem\Infrastructure\Factory\Character();

    $characterObjects = $factory->retrieveAllFromDb($connection);
    $characterList = [];

    foreach ($characterObjects as $character) {
        $characterList[] = $character->getName();
    }

    $output = new \Mikron\RpgSystem\Domain\Service\Output(
        "List",
        "This is a complete list of character available for your peruse. If the character you are looking for is not"
        ." here, please ensure you have correct access rights.",
        $characterList
    );

    return $app->json($output->getArrayForJson());
});
