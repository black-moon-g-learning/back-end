<?php

namespace Tests\Unit\Http\Controllers\Api\Auth;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    protected $authentication = ["Authorization" => " Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ODlmYzZiNi1jOTFkLTQ5NmYtOTY0MC02ZjdhMWM0ODE0ZDUiLCJqdGkiOiI5NTAxOGQ5ZWYzOWRjNTIyZGQ4OTJiNzQ5YzRlYmRiNmUyMDRlMjYwNjQwNTBmNjI1ZTg0YzRjMDhkZDBkMmIzYmUzOTk5ZGE2MDI1ZGEyOCIsImlhdCI6MTY3ODE1MzcyNi45MzA1NDMsIm5iZiI6MTY3ODE1MzcyNi45MzA1NDUsImV4cCI6MTcwOTc3NjEyNi45MTk0MzgsInN1YiI6IjEyIiwic2NvcGVzIjpbXX0.Wm6idCnKToCeSGyAA-8Ljn5ymZrg8A10S-S2FPNE5b4aJpzB_zSrZL1PoylaoqnM9JgarO0uFYAMUTq0lP2WpbSXR2gWyZwnurIOlnFj_76lAtIpmixZcQNdJKObfG7p5TBM3GC2cFlEftWrgVzuoDB5qvM9j4vH1gpyHjIhyawcFYE4sR9kjnimCwWLzgCzO3ebCu5awqK5eRMHtzFAEL8iYsyq6ube6mz0l9EQaq-3sh4cdJBYLOdV71ZJcddaelX-SuWG79SetDdSZUXveTg7fX0OKlaErdHIpM8WpgxhrFmdomiFkU8Lddu3ikShU9J2hGJ1BJYDiOHUWTNdAwz9ig2xM0M7ciTnMIvQQtB4ziNaZic1TK6IKYMJeGLZ6HHmnDRSx7hgNil9uAsgiiEhjCOz5ZrWTBcLB10PDsMW8kqFV2whkyuj-3zPgS1K3tHqc2LLcGvx07-zsI-7pbuLsplLsS-Z1muM7rp-gIW4j2IDl8VjWcAjxkTw4ACt2gy43ZYon4uv8O0Yqt3v0hn6n6OmDhr5B7b5SVkik9qP6E9vT3Qp0qMTEF9IOrxcPbz11CHbKQyiSSPU_iIJkCj3gbf1MLltA-0AdPwoIzw4gMSX4zaou4W5C1SJXnEC_Xslaj0KNS3b_zT6ieX-ONxDu3is29hi3EOXpkaC2cI"];
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_profile_fail()
    {
        $this->get(route('profile'))
            ->assertStatus(401)
            ->assertJsonIsObject()
            ->assertJsonStructure(["message", "data" => ["error"]]);
    }

    public function test_get_profile()
    {
        $this->get(route('profile'), $this->authentication)
            ->assertJsonIsObject()
            ->assertJsonStructure(["id", "username", "email", "password", "firstName", "lastName", "phone", "age", "gender", "character", "target", "role", "provider", "image"]);
        $this->assertAuthenticated();
    }

    
}
