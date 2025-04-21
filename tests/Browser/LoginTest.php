<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    
   
    /**
     * A Dusk test example.
     * @group login
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login') // Testing mengakses halaman http://127.0.0.1:8000/login
                    ->assertSee('LOG IN') // Mengecek apakah ada elemen Login
                    ->type('email', 'testuser@example.com') // Testing mengetikkan teks "testuser@example.com"
                    ->type('password', 'password123') // Testing mengetikkan password
                    ->press('LOG IN') // Testing menekan tombol registrasi
                    ->assertPathIs('/dashboard'); // Setelah berhasil register, browser akan redirect ke /dashboard
                    });
                }
}
