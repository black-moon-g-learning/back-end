<?php

namespace Tests\Unit\Http\Controllers\Web;

use App\Http\Controllers\Web\AuthController;
use App\Services\Auth\IAuthService;

use Tests\TestCase;
use Mockery as m;
use Tests\CreatesApplication;

class AuthControllerTest extends TestCase
{
    use CreatesApplication;
    protected AuthController $authController;
    protected $authMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authMock = m::mock(IAuthService::class)->makePartial();
        $this->authController = new AuthController(
            $this->app->instance(IAuthService::class, $this->authMock)
        );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_show_login_form()
    {
        $response = $this->get(route('web.login.get'));
        $response->assertStatus(200);
        $response->assertViewIs('pages.login');
    }
    
    // public function test_
}
