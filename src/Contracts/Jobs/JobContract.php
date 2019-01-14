<?php

namespace HyveMobileTest\Contracts\Jobs;

interface JobContract
{
    public function setUp();

    public function perform($args);

    public function tearDown();
}
