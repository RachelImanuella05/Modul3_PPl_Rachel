<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteNoteTest extends DuskTestCase
{
    /**
     * A Dusk test for deleting a note.
     */
    public function testDeleteNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com') // ganti dengan data login yang valid
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')

                // Masuk ke halaman Notes
                ->clickLink('Notes')
                ->assertPathIs('/notes')

                // Cari catatan "Catatan Uji Coba" lalu klik Delete yang sesuai
                ->with('.note-list', function ($noteList) {
                    $noteList->assertSee('Catatan Uji Coba');
                    $noteList->element('//div[contains(., "Catatan Uji Coba")]//button[contains(text(), "Delete")]')->click();
                })

                // Konfirmasi penghapusan jika ada pop-up browser (konfirmasi bawaan JS)
                ->whenAvailable('dialog[open]', function ($dialog) {
                    $dialog->accept(); // hanya dipakai kalau ada confirm()
                })

                // Pastikan catatan tidak ada lagi
                ->pause(1000) // beri waktu sejenak untuk refresh
                ->assertDontSee('Catatan Uji Coba');
        });
    }
}
