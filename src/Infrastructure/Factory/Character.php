<?php

namespace Mikron\RpgSystem\Infrastructure\Factory;

use Mikron\RpgSystem\Domain\Entity;
use Mikron\RpgSystem\Domain\Exception\CharacterNotFoundException;
use Mikron\RpgSystem\Domain\Value\StorageData;
use Mikron\RpgSystem\Infrastructure\Storage\StorageForCharacter;

class Character
{
    public function createFromSingleArray($name, $ego, $storageData)
    {
        return new Entity\character($name, $ego, $storageData);
    }

    /**
     * Creates character objects from array
     * @param $array
     * @return Character[]
     */
    public function createFromCompleteArray($array)
    {
        $list = [];

        if (!empty($array)) {
            foreach ($array as $record) {
                $storageData = new StorageData($record['character_id']);
                $list[] = $this->createFromSingleArray($record['name'], null, $storageData);
            }
        }

        return $list;
    }

    /**
     * Retrieves character objects from database
     *
     * @param $connection
     * @return array
     */
    public function retrieveAllFromDb($connection)
    {
        $characterStorage = new StorageForCharacter($connection);

        $array = $characterStorage->retrieveAll();

        $list = [];

        if (!empty($array)) {
            foreach ($array as $record) {
                $storageData = new StorageData($record['character_id']);
                $list[] = $this->createFromSingleArray($record['name'], null, $storageData);
            }
        }

        return $list;
    }

    public function retrieveCharacterFromDb($connection, $dbId)
    {
        $characterStorage = new StorageForCharacter($connection);

        $characterWrapped = $characterStorage->retrieve($dbId);

        if (!empty($characterWrapped)) {
            $characterUnwrapped = array_pop($characterWrapped);

            $storageData = new StorageData($characterUnwrapped['character_id']);

            $character = $this->createFromSingleArray($characterUnwrapped['name'], null, $storageData);
        } else {
            throw new CharacterNotFoundException("Character with given ID has not been found in our database");
        }

        return $character;
    }
}
