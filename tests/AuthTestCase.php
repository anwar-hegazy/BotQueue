<?php

class AuthTestCase extends TestCase
{
    protected $user;

    public function setUp() {
        parent::setUp();

        $this->artisan('migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

        $this->user = factory(App\Models\User::class)->create();
        $this->actingAs($this->user);
    }
}