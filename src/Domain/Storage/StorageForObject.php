<?php

namespace Mikron\RpgSystem\Domain\Storage;

interface StorageForObject
{
    public function retrieve($dbId);
    public function retrieveAll();
}
