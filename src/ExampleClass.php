<?php

namespace HyveMobileTest;

require '../boot.php';

/**
 * Class ExampleClass
 *
 * @package HyveMobileTest
 */
class ExampleClass {
    /**
     * ExampleClass constructor.
     */
    public function __construct() {
        printf('Congratulations, you have successfully instantiated "%s".', __CLASS__);
    }

    /**
     * @return string
     */
    public function helloWorldEcho() : string {
        return 'Hello, world!';
    }
}
