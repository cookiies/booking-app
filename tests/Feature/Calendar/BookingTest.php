<?php

namespace Tests\Feature\Calendar;

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
    protected $seeder = CalendarBookingSeeder::class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->User::factory()->create();
    }
    
    /**
     * Database testing on http responses from Inertia's Laravel adapter.
     *
     * @return void
     */
    public function test_can_view_calendar_bookings()
    {
        $response = $this->get('/bookings');

        $response->assertStatus(200);
    }
}
