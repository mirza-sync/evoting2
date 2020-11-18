<?php

namespace Tests;
use App\User;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

     
      Public function setup()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    Public function logInUser($args = [])
    {
        $user = factory(User::class)->create($args);
        $this->actingAs($user);
        return $user;
    }
    
}
