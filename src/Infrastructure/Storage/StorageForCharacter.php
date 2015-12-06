<?php

namespace Mikron\RpgSystem\Infrastructure\Storage;

use Mikron\RpgSystem\Domain\Storage\StorageForObject;

final class StorageForCharacter implements StorageForObject
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * MySqlPerson constructor.
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function retrieve($dbId)
    {
        $result = $this->storage->selectByPrimaryKey('character', 'character_id', [$dbId]);

        return $result;
    }

    public function retrieveAll()
    {
        $result = $this->storage->selectAll('character', 'character_id');

        return $result;
    }
}
