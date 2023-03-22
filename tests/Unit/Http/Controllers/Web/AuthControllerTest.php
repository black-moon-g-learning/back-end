<?php

namespace Tests\Unit\Http\Controllers\Web;

use App\Http\Controllers\Web\AuthController;
use App\Services\Auth\IAuthService;
use App\Services\Auth\WebAuthService;
use Tests\TestCase;
use Mockery as m;
use Tests\CreatesApplication;

class AuthControllerTest extends TestCase
{
    // use CreatesApplication;
    // protected AuthController $authController;
    // protected $authMock;

    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     $this->authMock = m::mock(WebAuthService::class);
    //     $this->authController = new AuthController(
    //         $this->app->instance(IAuthService::class, $this->authMock)
    //     );
    // }

    public function test_show_login_form()
    {
        $response = $this->get(route('web.login.get'));
        $response->assertStatus(200);
        $response->assertViewIs('pages.login');
    }

    public function test_post_login()
    {
        $loginData = ['username' => 'admin@gmail.com', 'password' => 'password'];

        $this->post(route('web.login.post'), $loginData)
            ->assertStatus(302)
            ->assertRedirect(route('web.dashboard'));
        $this->assertAuthenticated();
    }

    // public function test_post_login_fail()
    // {
    //     $loginData = ['username' => 'admin@gmail.com', 'password' => ''];

    //     $this->post(route('web.login.post'), $loginData)
    //         ->assertStatus(302)
    //         ->assertRedirect(route('web.login.get'));
    // }

    public function test_logout()
    {
        $this->get(route('web.logout'))
            ->assertStatus(302)
            ->assertRedirectToRoute('web.login.get');
    }
}
