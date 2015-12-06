<?php

namespace Mikron\RpgSystem\Domain\Concept;

use Mikron\RpgSystem\Domain\Blueprint\Collectible;
use Mikron\RpgSystem\Domain\Value\Code;
use Mikron\RpgSystem\Domain\Value\Description;
use Mikron\RpgSystem\Domain\Value\Name;

/**
 * Class SkillGroup - representation of a profession, skill aggregation or simple group
 * @package Mikron\HubBack\Domain\Concept
 * @todo This class should be displayable
 */
class SkillGroup implements Collectible
{
    /**
     * @var Code
     */
    private $code;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Description
     */
    private $description;

    /**
     * SkillGroup constructor.
     * @param Code $code
     * @param Name $name
     * @param Description $description
     */
    public function __construct(Code $code, Name $name, Description $description)
    {
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return Code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array Simple representation of the object content, fit for basic display
     */
    public function getSimpleData()
    {
        return [
            "name" => $this->getName()
        ];
    }

    /**
     * @return array Complete representation of public parts of object content, fit for full card display
     */
    public function getCompleteData()
    {
        return [
            "name" => $this->getName(),
            "description" => $this->getDescription()
        ];
    }

    public function getKey()
    {
        return $this->code->getCode();
    }
}
