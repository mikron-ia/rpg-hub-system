<?php

namespace Mikron\RpgSystem\Domain\Concept;

use Mikron\RpgSystem\Domain\Blueprint\Collection;

/**
 * Class SkillCollection
 * @package Mikron\RpgSystem\Domain\Concept
 */
class SkillCollection extends Collection
{
    protected function isValid($validatedObject)
    {
        return $validatedObject instanceof Skill;
    }
}