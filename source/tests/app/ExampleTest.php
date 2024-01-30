<?php

namespace app;

use CodeIgniter\Test\CIUnitTestCase;

class ExampleTest extends CIUnitTestCase
{
    public function testFailed()
    {
        $this->assertEquals(1, 2);
    }
}