<?php

namespace Tests\Feature\Booking;

use App\Models\Booking;
use App\Models\User;
use Database\Seeders\BookingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Inertia\Testing\AssertableInertia as Assert;
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

    /**
     * Booking routes that are used by the user.
     * 
     * @var array
     */
    private $booking_routes = [
        'bookings.index',
        'bookings.create',
        'bookings.store',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->seed([
            UserSeeder::class,
            BookingSeeder::class,
        ]);
    }

    /**
     * Route Testing ensure resources available.
     */
    public function test_routes_to_resources_available()
    {
        foreach ($this->booking_routes as $route) {
            $this->assertTrue(Route::has($route));

            $response = $this->actingAs($this->user)
                ->get(route($route));
            $response->assertStatus(200);
        }
    }

    /**
     * HTTP Testing route for guest user.
     *
     * @return void
     */
    public function test_can_view_booking_page_as_guest_user()
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
    public function test_can_view_booking_page_as_user()
    {
        $response = $this->actingAs($this->user)
            ->get('/bookings');

        $response->assertStatus(200);
    }

    public function test_can_get_bookings_from_database_as_user()
    {
        $bookings = Booking::take(2)->get();
        
        $this->actingAs($this->user)
            ->get('/bookings')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Bookings/Index')
                ->has('bookings', Booking::all()->count())
                ->has( 'bookings.0', fn (Assert $assert) => $assert
                    ->where('id', $bookings[0]->id)
                    ->where('title', $bookings[0]->title)
                    ->where('start', $bookings[0]->start)
                    ->where('end', $bookings[0]->end)
                    ->where('user_id', $bookings[0]->user_id)
                    ->etc()
                )
                ->has('bookings.1', fn (Assert $assert) => $assert
                    ->where('id', $bookings[1]->id)
                    ->where('title', $bookings[1]->title)
                    ->where('start', $bookings[1]->start)
                    ->where('end', $bookings[1]->end)
                    ->where('user_id', $bookings[1]->user_id)
                    ->etc()
                )
            );
    }

    public function test_can_see_bookings_table()
    {
        $bookings = Booking::latest()->get()->toArray();

        $response = $this->actingAs($this->user)
            ->get('/bookings');

        $response->assertSee($bookings[0]);
    }

    // public function test_can_see_create_booking_button()
    // {
        // $response = $this->actingAs($this->user)
        //     ->get('/bookings');

        // $response->assertSeeInOrder([
        //     "button",
        //     "Create Booking"
        // ]);

        // $this->actingAs($this->user)
        //     ->get('/bookings')
        //     ->assertInertia(fn (Assert $assert) => $assert
        //         ->component('Bookings/Index'));
    // }

}
