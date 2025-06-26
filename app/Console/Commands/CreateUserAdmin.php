<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat akun admin baru';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Masukkan nama admin:');
        $username = $this->ask('Masukkan username admin:');
        $email = $this->ask('Masukkan alamat email admin:');
        $password = $this->secret('Buat password:');
        $passwordConfirmation = $this->secret('Konfirmasi password baru:');

        if ($password !== $passwordConfirmation) {
            $this->error('Password tidak sama!');
            return 1;
        }

        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Berhasil membuat akun admin baru!');

        return 0;
    }
}
