<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewNotesTest extends DuskTestCase
{
    /**
     * A Dusk test for viewing notes.
     * @group viewnote
     */
    public function testViewNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login') // Akses halaman login
                ->type('email', 'testuser@example.com')   // Ganti dengan user valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Buka halaman Notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')

                // Verifikasi isi catatan (optional, bisa ditambahkan jika perlu)
                ->assertSee('Catatan Uji Coba');
        });
    }
}
