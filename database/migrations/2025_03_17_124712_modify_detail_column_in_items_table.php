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
            // NULLを許容し、デフォルト値を空文字に設定
            $table->string('detail')->nullable()->default('')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // detailカラムを元に戻す（NULL非許容、デフォルト値なし）
            $table->string('detail')->nullable(false)->change();
        });
    }
};
