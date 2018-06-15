<?php

namespace Tests\Feature;

use App\Barber;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BarberTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->showExceptions();
    }

    /**
     * @test
     */
    public function a_user_can_visit__the_barber_registration_page()
    {
        $user = factory(User::class)->create();

        $response = $this->get('/barbers/register');

        $response->assertSuccessful();
        $response->assertViewIs('barber.register');
    }

    /**
     * @test
     */
    public function a_user_can_register_as_a_barber()
    {
        $barber = factory(Barber::class)->make();

        $response = $this->post('/barbers', [
            'name' => $barber->name,
            'email' => $barber->email,
            'phone_number' => $barber->phone_number,
            'image' => $barber->image,
            'is_barber' => true,
            'city' => $barber->city,
            'state' => $barber->state,
            'password' => $barber->password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/barbershop/register');
        $this->assertCount(1, Barber::all());
    }

    /**
     * @test
     */
    public function a_registered_barber_can_update_their_profile()
    {
        $barber = factory(Barber::class)->create([
            'name' => 'Big John Johnson',
            'city' => 'Bowling Green',
            'state' => 'Ky',
        ]);

        $response = $this->actingAs($barber)->patch('/barbers/' . $barber->id, [
            'name' => 'William Jones',
            'city' => 'Lexington',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('status', 'Your profile was updated!');
        $this->assertSame('William Jones', $barber->fresh()->name);
        $this->assertSame('Lexington', $barber->fresh()->city);
    }

    /**
     * @test
     */
    public function a_registered_barber_can_not_update_another_barber_profile()
    {
        $shawn_the_barber = factory(Barber::class)->create();
        $jose_the_barber = factory(Barber::class)->create([
            'name' => 'Big John Johnson',
            'city' => 'Bowling Green',
            'state' => 'Ky',
        ]);

        $response = $this->actingAs($shawn_the_barber)->patch('/barbers/' . $jose_the_barber->id, [
            'name' => 'William Jones',
            'city' => 'Lexington',
        ]);

        $response->assertStatus(403);
        $response->assertViewIs('forbidden');
        $this->assertSame('Big John Johnson', $jose_the_barber->name);
        $this->assertSame('Bowling Green', $jose_the_barber->city);
    }

    /**
     * @test
     */
    public function a_registered_barber_can_reduce_their_profile_to_user_level()
    {
        $shawn_the_barber = factory(Barber::class)->create();

        $response = $this->actingAs($shawn_the_barber)->patch('/barbers/' . $shawn_the_barber->id, [
            'is_barber' => false,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'Your profile was updated!');
        $this->assertCount(0, Barber::all());
    }

    /**
     * @test
     */
    public function a_registered_barber_can_delete_profile()
    {
        $shawn_the_barber = factory(Barber::class)->create();

        $response = $this->actingAs($shawn_the_barber)->delete('/barbers/' . $shawn_the_barber->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('status', 'Your barber profile was deleted!');
        $this->assertCount(0, Barber::all());
    }

    /**
     * @test
     */
    public function a_registered_barber_can_not_delete_another_barbers_profile()
    {
        $shawn_the_barber = factory(Barber::class)->create();
        $jose_the_barber = factory(Barber::class)->create();

        $response = $this->actingAs($shawn_the_barber)->delete('/barbers/' . $jose_the_barber->id);

        $response->assertStatus(403);
        $response->assertViewIs('forbidden');
        $response->assertViewHas('message', 'You are not allowed to delete this profile');
        $this->assertCount(2, Barber::all());
    }

    /**
     * @test
     */
    public function a_registered_user_can_not_update_a_barbers_profile()
    {
        $shawn = factory(User::class)->create();
        $jose_the_barber = factory(Barber::class)->create();

        $response = $this->actingAs($shawn)->patch('/barbers/' . $jose_the_barber->id);

        $response->assertStatus(403);
        $response->assertViewIs('forbidden');
        $response->assertViewHas('message', 'You are not allowed to edit this profile');
        $this->assertCount(1, Barber::all());
    }

    /**
     * @test
     */
    public function a_registered_user_can_not_delete_a_barbers_profile()
    {
        $shawn = factory(User::class)->create();
        $jose_the_barber = factory(Barber::class)->create();

        $response = $this->actingAs($shawn)->delete('/barbers/' . $jose_the_barber->id);

        $response->assertStatus(403);
        $response->assertViewIs('forbidden');
        $response->assertViewHas('message', 'You are not allowed to delete this profile');
        $this->assertCount(1, Barber::all());
    }

    /**
     * @test
     */
    public function any_user_can_view_a_barbers_profile()
    {
        $jose_the_barber = factory(Barber::class)->create();

        $response = $this->get('/barbers/' . $jose_the_barber->id);

        $response->assertSuccessful();
        $response->assertViewIs('barber.profile');
        $response->assertViewHas('barber');
    }
}
