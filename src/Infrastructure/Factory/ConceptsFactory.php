<?php

namespace Mikron\RpgSystem\Infrastructure\Factory;

use Mikron\RpgSystem\Domain\Concept\Skill;
use Mikron\RpgSystem\Domain\Concept\SkillGroup;
use Mikron\RpgSystem\Domain\Concept\SkillGroupCollection;
use Mikron\RpgSystem\Domain\Exception\IncorrectConfigurationComponentException;
use Mikron\RpgSystem\Domain\Value\Code;
use Mikron\RpgSystem\Domain\Value\Description;
use Mikron\RpgSystem\Domain\Value\Name;

/**
 * Class ConceptsFactory
 * @package Mikron\RpgSystem\Infrastructure\Factory
 */
class ConceptsFactory
{
    /**
     * @param array $payload
     * @param SkillGroupCollection $completeSkillGroupCollection
     * @return Skill
     * @throws IncorrectConfigurationComponentException
     */
    public function createSkillFromArray($payload, $completeSkillGroupCollection)
    {
        $skillGroupListForSkill = [];

        foreach ($payload['groups'] as $skillGroupName) {
            $skillGroup = $completeSkillGroupCollection->findByIndex($skillGroupName);
            if ($skillGroup === null) {
                throw new IncorrectConfigurationComponentException("Non-existing skill group name '$skillGroupName' in configuration of " . $payload['code'] . " skill");
            }

            $skillGroupListForSkill[] = $skillGroup;
        }

        $skillSkillGroupCollection = $this->createSkillGroupCollectionFromList($skillGroupListForSkill);

        return new Skill(new Code($payload['code']), new Name($payload['name'], 'en'), new Description($payload['description'], 'en'), $skillSkillGroupCollection);
    }

    /**
     * @param $payload
     * @return SkillGroup
     */
    public function createSkillGroupFromArray($payload)
    {
        return new SkillGroup(new Code($payload['code']), new Name($payload['name'], 'en'), new Description($payload['description'], 'en'));
    }

    /**
     * @param array $array
     * @return SkillGroupCollection
     */
    public function createSkillCollectionFromList(array $array)
    {
        $created = [];

        foreach ($array as $arrayItem) {
            if ($arrayItem instanceof Skill) {
                $created[] = $arrayItem;
            } else {
                $created[] = $this->createSkillFromArray($arrayItem);
            }
        }

        $collection = new SkillCollection($created);

        return $collection;
    }

    /**
     * @param array $array
     * @return SkillGroupCollection
     */
    public function createSkillGroupCollectionFromList(array $array)
    {
        $created = [];

        foreach ($array as $arrayItem) {
            if ($arrayItem instanceof SkillGroup) {
                $created[] = $arrayItem;
            } else {
                $created[] = $this->createSkillGroupFromArray($arrayItem);
            }
        }

        $collection = new SkillGroupCollection($created);

        return $collection;
    }
}
