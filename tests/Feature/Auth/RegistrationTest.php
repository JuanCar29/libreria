<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_is_not_available(): void
    {
        $this->markTestSkipped('El registro de usuarios está deshabilitado en esta aplicación.');
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->markTestSkipped('El registro de usuarios está deshabilitado en esta aplicación.');
    }

    public function test_new_users_can_register(): void
    {
        $this->markTestSkipped('El registro de usuarios está deshabilitado en esta aplicación.');
    }
}
