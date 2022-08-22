<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;        // database transaction executed with the testcase.
    // use DatabaseMigrations;  // significantly slower but runs all migrations again.

    /**
     * Indicates whether the defaul seeder should run before each test.
     * 
     * @var string
     */
    // protected $seeder = SeederClassNameSeeder::class;

    /**
     * Database testing using RefreshDatabase.
     *
     * @return void
     */
    // public function test_the_application_returns_a_successful_response()
    // {
        // $user = User::factory()->create();

        // $this->seed();

        // $count = User::count();

        // assertEquals(10, $count);
    // }
}
