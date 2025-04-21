<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditNoteTest extends DuskTestCase
{
    /**
     * A Dusk test for editing a note.
     */
    public function testEditNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com') // ganti dengan data login yang valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Masuk ke halaman notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')

                // Cari note "Catatan Uji Coba", lalu klik tombol Edit yang sesuai
                ->with('.note-list', function ($noteList) {
                    $noteList->assertSee('Catatan Uji Coba');
                    $noteList->element('//div[contains(., "Catatan Uji Coba")]//a[contains(text(), "Edit")]')->click();
                })

                // Sekarang form edit muncul
                ->assertPathContains('/notes/') // pastikan kita berada di route edit
                ->assertInputValue('title', 'Catatan Uji Coba') // validasi value lama

                // Edit isi note
                ->type('title', 'Catatan Uji Coba - Versi Baru')
                ->type('description', 'Isi catatan ini sudah diedit menggunakan Laravel Dusk.')

                // Submit perubahan
                ->press('UPDATE') // pastikan tombolnya "UPDATE" atau ganti sesuai
                ->assertSee('Catatan Uji Coba - Versi Baru');
        });
    }
}
