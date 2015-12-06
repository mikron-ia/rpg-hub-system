<?php

namespace Mikron\RpgSystem\Domain\Concept;

use Mikron\RpgSystem\Domain\Blueprint\Collection;

class SkillCollection extends Collection
{
    protected function isValid($validatedObject)
    {
        return $validatedObject instanceof Skill;
    }
}