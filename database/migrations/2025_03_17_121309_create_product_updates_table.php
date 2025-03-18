<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('items');  // Itemsテーブルとの外部キー
            $table->foreignId('user_id')->constrained('users');    // Usersテーブルとの外部キー
            $table->text('changes'); // 更新内容を保存
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_updates');
    }
};
