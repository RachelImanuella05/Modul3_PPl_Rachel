<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateNoteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testCreateNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com') // Ganti dengan email user terdaftar
                ->type('password', 'password123')       // Ganti juga passwordnya
                ->press('LOG IN')                         // Teks tombol login
                ->assertPathIs('/dashboard')             // Atau path setelah login

                // Buka menu Notes
                ->clickLink('Notes')                     // Atau bisa pakai selector, tergantung navbar kamu
                ->assertPathIs('/notes')                 // Cek halaman Notes

                // Buka form Create Note
                ->clickLink('Create Note')                   // Tombol untuk buat note baru

                // Isi form note
                ->type('title', 'Catatan Uji Coba')      // Sesuaikan name/ID input
                ->type('description', 'Ini adalah isi dari catatan ujicoba Laravel Dusk.')

                // Submit form
                ->press('CREATE')                        // Tombol submit

                // Verifikasi berhasil
                ->assertSee('Catatan Uji Coba');         // Pastikan note muncul
            });
        }
}