<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
{
    /**
     * A Dusk test for logging out.
     */
    public function testLogout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')  // ganti dengan akun yang valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Klik nama user di pojok kanan atas (dropdown), lalu tekan Logout
                ->click('@user-dropdown') // atau klik teks seperti 'rachel' jika tidak pakai dusk selector
                ->clickLink('Logout')

                // Verifikasi logout berhasil dan kembali ke halaman login
                ->assertPathIs('/login')
                ->assertSee('LOG IN');
        });
    }
}
