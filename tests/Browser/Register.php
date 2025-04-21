<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Register extends DuskTestCase
{


    /**
     * A Dusk test for user registration.
     * @group register
     */
    public function testRegister(): void
    {
        $this->browse(function (Browser $browser) { // Memulai testing dusk
            $browser->visit('http://127.0.0.1:8000/register') // Testing mengakses halaman http://127.0.0.1:8000/register
                    ->assertSee('REGISTER') // Mengecek apakah ada elemen Registrasi
                    ->type('name', 'Test User') // Testing mengetikkan teks "Test User"
                    ->type('email', 'testuser@example.com') // Testing mengetikkan teks "testuser@example.com"
                    ->type('password', 'password123') // Testing mengetikkan password
                    ->type('password_confirmation', 'password123') // Testing mengetikkan confirm password
                    ->press('REGISTER') // Testing menekan tombol registrasi
                    ->assertPathIs('/dashboard'); // Setelah berhasil register, browser akan redirect ke /dashboard
                    });
                }
}
