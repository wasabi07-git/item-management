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
            if (!Schema::hasColumn('items', 'product_number')) {
                $table->string('product_number')->unique();  // 商品番号
            }
            if (!Schema::hasColumn('items', 'sale_start_date')) {
                $table->date('sale_start_date')->nullable(); // 販売開始日
            }
            if (!Schema::hasColumn('items', 'price')) {
                $table->decimal('price', 10, 2);             // 価格
            }       
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['product_number', 'sale_start_date', 'price']);
        });
    }
};
