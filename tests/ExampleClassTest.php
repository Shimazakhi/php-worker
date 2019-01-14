<?php

class ExampleClassTest extends \PHPUnit\Framework\TestCase
{
    public function testHelloWorldEcho() {
        $exampleClass = new \HyveMobileTest\ExampleClass();
        $this->assertEquals('Hello, world!', $exampleClass->helloWorldEcho());
    }
}
