<?php

use Mikron\RpgSystem\Domain\Concept\Skill;
use Mikron\RpgSystem\Domain\Value\Code;
use Mikron\RpgSystem\Domain\Value\Description;
use Mikron\RpgSystem\Domain\Value\Name;

class SkillConceptTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider correctSkillDataProvider
     * @param $code
     * @param $name
     * @param $description
     * @param $skillGroupCollection
     */
    function isCodeCorrect($code, $name, $description, $skillGroupCollection)
    {
        $skill = new Skill($code, $name, $description, $skillGroupCollection);
        $this->assertEquals($name, $skill->getName());
    }

    /**
     * @test
     * @dataProvider correctSkillDataProvider
     * @param $code
     * @param $name
     * @param $description
     * @param $skillGroupCollection
     */
    function isNameCorrect($code, $name, $description, $skillGroupCollection)
    {
        $skill = new Skill($code, $name, $description, $skillGroupCollection);
        $this->assertEquals($name, $skill->getName());
    }

    /**
     * @test
     * @dataProvider correctSkillDataProvider
     * @param $code
     * @param $name
     * @param $description
     * @param $skillGroupCollection
     */
    function isDescriptionCorrect($code, $name, $description, $skillGroupCollection)
    {
        $skill = new Skill($code, $name, $description, $skillGroupCollection);
        $this->assertEquals($description, $skill->getDescription());
    }

    /**
     * @test
     * @dataProvider correctSkillDataProvider
     * @depends      isNameCorrect
     * @param $code
     * @param $name
     * @param $description
     */
    function isSimpleDisplayCorrect($code, $name, $description, $skillGroupCollection)
    {
        $skill = new Skill($code, $name, $description, $skillGroupCollection);

        $expectation = [
            "name" => $skill->getName()
        ];

        $this->assertEquals($expectation, $skill->getSimpleData());
    }

    /**
     * @test
     * @dataProvider correctSkillDataProvider
     * @param $code
     * @param $name
     * @param $description
     * @param $skillGroupCollection
     * @internal param $skillGroups
     */
    function isComplexDisplayCorrect($code, $name, $description, $skillGroupCollection)
    {
        $skill = new Skill($code, $name, $description, $skillGroupCollection);

        $expectation = [
            "name" => $skill->getName(),
            "description" => $skill->getDescription()
        ];

        $this->assertEquals($expectation, $skill->getCompleteData());
    }

    public function correctSkillDataProvider()
    {
        return [
            [
                new Code('KNOW-GEOGRAPHY'),
                new Name(['en' => 'Knowledge (Geography)'], 'en'),
                new Description(['en' => 'Lore regarding various landmarks on Mars'], 'en'),
                new \Mikron\RpgSystem\Domain\Concept\SkillGroupCollection([]),
            ]
        ];
    }
}