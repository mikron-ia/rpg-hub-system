<?php

class CodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function isCodeCorrect()
    {
        $name = "Test Code";
        $code = new \Mikron\RpgSystem\Domain\Value\Code($name);
        $this->assertEquals($name, $code->getCode());
    }

    /**
     * @test
     */
    public function isEmptyCodeRecognised()
    {
        $this->setExpectedException('\Mikron\RpgSystem\Domain\Exception\IncorrectConfigurationComponentException');
        new \Mikron\RpgSystem\Domain\Value\Code("");
    }
}
