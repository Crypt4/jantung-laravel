<?php

namespace Crypt4\JantungLaravel\Tests\Features;

use Crypt4\JantungLaravel\Tests\TestCase;

class CoreTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // $this->artisan('jantung:install');
    }

    /**
     * A basic test example.
     */
    public function test_core(): void
    {
        $this->assertTrue(true);
    }
}
