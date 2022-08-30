<?php

namespace Tests\Feature\Calendar;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use phpDocumentor\Reflection\Types\Void_;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Initial seeder to create test data in database.
     * 
     * @var string
     */
    // protected $seeder = CalendarBookingSeeder::class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->seed([
            UserSeeder::class,
            CalendarBookingSeeder::class,
        ]);
    }
    
    /**
     * HTTP Testing route for guest user.
     *
     * @return void
     */
    public function test_cannot_view_calendar_bookings_as_guest_user()
    {
        $response = $this->get('/bookings');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }
    
    /**
     * HTTP Testing route for authenticated user.
     *
     * @return void
     */
    public function test_can_view_calendar_bookings_as_user()
    {
        $response = $this->actingAs($this->user)
                        ->get('/bookings');
        
        $response->assertOk();
    }
    
    /**
     * Database testing on http responses from Inertia's Laravel adapter.
     *
     * @return void
     */
}
