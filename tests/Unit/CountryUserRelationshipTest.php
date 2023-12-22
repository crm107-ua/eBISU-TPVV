<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Country;
use App\Models\User;

class CountryUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    protected $erik;
    protected $javier;
    protected $spain;

    public function setUp(): void
    {
        parent::setUp();

        $this->spain = Country::where('code', 'ES')->first();

        $this->erik = new User([
            'name' => 'Erik',
            'email' => 'erik@gmail.com',
            'password' => '12345678',
            'role' => 'admin',
            'direction_direction' => 'Calle de la piruleta',
            'direction_postal_code' => '12345',
            'direction_poblation' => 'Madrid',
        ]);

        $this->erik->country()->associate($this->spain);
        $this->erik->save();

        $this->javier = new User([
            'name' => 'Javier',
            'email' => 'javier@mail.com',
            'password' => '12345678',
            'role' => 'admin',
            'direction_direction' => 'Calle de la piruleta',
            'direction_postal_code' => '12345',
            'direction_poblation' => 'Madrid',
        ]);

        $this->javier->country()->associate($this->spain);
        $this->javier->save();
    }


    public function test_user_country_relationship()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Erik']);
        $this->assertEquals('ES', $this->erik->country->code);
        $this->assertTrue($this->spain->users->contains($this->erik));
    }

    public function test_check_users_from_country()
    {
        $this->assertEquals(2, $this->spain->users->count());
        $this->assertTrue($this->spain->users->contains($this->erik));
        $this->assertTrue($this->spain->users->contains($this->javier));
        $this->assertEquals('ES', $this->erik->country->code);
        $this->assertEquals('ES', $this->javier->country->code);
    }
}
