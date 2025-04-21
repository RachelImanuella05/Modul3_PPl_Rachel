<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewNotesTest extends DuskTestCase
{
    /**
     * A Dusk test for viewing notes.
     */
    public function testViewNotes(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')  // Ganti dengan user yang valid
                ->type('password', 'password123')       
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Buka halaman Notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')

                // Verifikasi bahwa notes tertentu tampil
                ->assertSee('Catatan Uji Coba')           // Salah satu note yang harus muncul
                ->assertSee('Tugas Modul 3');             // Note lain juga bisa dicek
        });
    }
}
