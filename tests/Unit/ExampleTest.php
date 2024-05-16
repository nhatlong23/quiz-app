<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
