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
        Schema::table('items', function (Blueprint $table) {
            // categoryカラムをNULL許容、デフォルト値を空文字に設定
            $table->string('category')->nullable()->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
             // categoryカラムを元に戻す（NULL非許容、デフォルト値なし）
             $table->string('category')->nullable(false)->change();
        });
    }
};
