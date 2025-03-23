<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //管理者の設定
        \App\Models\User::create([
        'name' => 'taro',
        'email' => 'tech.taro@gmail.com',
        'is_admin' => true, // 管理者として設定
        'password' => bcrypt('12345678'), 
        ]);

        
        User::where('id', 4)->update(['is_admin' => 1]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
