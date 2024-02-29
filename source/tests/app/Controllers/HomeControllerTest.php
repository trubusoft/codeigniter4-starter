<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;

class HomeControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    public function testIndex()
    {
        $result = $this
            ->controller(HomeController::class)
            ->execute('index');

        $result->assertOK();
        $this->assertNotNull($result->response()->getBody());
        $this->assertTrue($result->see('Welcome to CodeIgniter'));
        $this->assertTrue($result->see('The small framework with powerful features'));
        $this->assertTrue($result->see('About this page'));
    }
}
