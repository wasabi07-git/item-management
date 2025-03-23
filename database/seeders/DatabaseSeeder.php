<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 管理者の設定（すでに存在しない場合のみ作成）
        User::firstOrCreate(
            ['email' => 'tech.taro@tecis.com'], // 既存のメールアドレスがあれば、それを使用
            [
                'name' => 'taro',
                'is_admin' => true, // 管理者として設定
                'password' => bcrypt('12345678'),
            ]
        );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
