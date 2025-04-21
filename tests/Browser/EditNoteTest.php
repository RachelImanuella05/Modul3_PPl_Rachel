<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditNoteTest extends DuskTestCase
{
    /**
     * A Dusk test for editing a note.
     * @group editnote
     */
    public function testEditNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login') // Akses halaman login
                ->type('email', 'testuser@example.com') // Ganti dengan user valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Masuk ke halaman notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')
                ->assertSee('Catatan Uji Coba') // Note yang ingin diedit

                // Edit note (dengan asumsi ada tombol atau link Edit)
                ->clickLink('Edit') // Sesuaikan jika pakai Dusk selector
                ->assertPathBeginsWith('/edit-note-page/')
                ->type('title', 'Catatan Uji Coba Diupdate')
                ->type('description', 'Isi catatan setelah diedit.')
                ->press('UPDATE')
                ->assertPathIs('/notes')
                ->assertSee('Catatan Uji Coba Diupdate');
        });
    }
}
