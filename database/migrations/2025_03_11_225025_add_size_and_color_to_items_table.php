<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeAndColorToItemsTable extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            if (!Schema::hasColumn('items', 'size')) {
                $table->string('size')->nullable(); // サイズカラムを追加
            }
            if (!Schema::hasColumn('items', 'color')) {
                $table->string('color')->nullable(); // カラーカラムを追加
            }
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->dropColumn('color');
        });
    }
}

