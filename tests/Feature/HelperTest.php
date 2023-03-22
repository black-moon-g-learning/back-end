<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Mockery as m;

class HelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_isUserPayment()
    {
        // Mock a user with Id = 12
        $user = m::mock(User::class)->makePartial();
        $user->shouldReceive('getAttribute')->with('id')->andReturn(12);
        $this->actingAs($user);

        $this->assertTrue(isUserPayment());
    }

    public function test_get_username()
    {
        $user = m::mock(User::class)->makePartial();
        $user->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $user->shouldReceive('getAttribute')->with('first_name')->andReturn("Hieu");
        $user->shouldReceive('getAttribute')->with('last_name')->andReturn("Tran");
        $name = getUsername($user);
        $this->assertEquals("Hieu Tran", $name);
    }

    public function test_convert_time_from_database()
    {
        $time = convertTimeFromDB(121);
        $this->assertEquals('2 : 1',$time);
    }
}
