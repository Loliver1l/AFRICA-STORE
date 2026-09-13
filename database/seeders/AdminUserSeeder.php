<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email'=>env('ADMIN_EMAIL','admin@yourstore.com')],[
            'name'=>env('ADMIN_NAME','Store Admin'),
            'phone'=>env('ADMIN_PHONE') ?: null,
            'password'=>env('ADMIN_PASSWORD','change-this-password'),
            'role'=>'admin','email_verified_at'=>now(),
        ]);
    }
}
