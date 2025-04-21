<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteNoteTest extends DuskTestCase
{
    /**
     * A Dusk test for deleting a note.
     * @group deletenote
     */
    public function testDeleteNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login') // Akses halaman login
                ->type('email', 'testuser@example.com')    // Ganti dengan akun yang valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Masuk ke halaman Notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')

                // Menekan tombol Delete
                ->press('Delete')

                // Verifikasi penghapusan berhasil
                ->assertSee('Note has been deleted');
        });
    }
}
