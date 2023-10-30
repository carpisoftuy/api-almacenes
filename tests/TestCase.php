<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void {
        parent::setUp();

        // Configura la base de datos de prueba
        $this->artisan('migrate');
    }

}
