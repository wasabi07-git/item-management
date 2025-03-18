<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [ItemController::class, 'index'])->name('items.index');

Route::prefix('items')->group(function () {
    // 商品一覧ページ (GET)
    Route::get('/', [ItemController::class, 'index'])->name('items.index');
    
    // 商品登録フォームページ (GET)
    Route::get('/create', [ItemController::class, 'create'])->name('items.create');
    
    // 商品登録処理 (POST)
    Route::post('/add', [ItemController::class, 'store'])->name('items.store');
    
    // 商品編集ページ (GET)
    Route::get('/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/{item}', [ItemController::class, 'update'])->name('items.update');
    
        // CSVインポート
    Route::get('import', [ItemController::class, 'showImportForm'])->name('items.import');
    Route::post('import', [ItemController::class, 'import'])->name('items.import');
    
    
    // 商品詳細ページ (GET)
    Route::get('/{item}', [ItemController::class, 'show'])->name('items.show');
    // 商品削除処理 (DELETE)
    Route::delete('/bulkDelete', [ItemController::class, 'bulkDelete'])->name('items.bulkDelete');

    // 更新履歴ページ
    Route::get('/{item}/history', [ItemController::class, 'history'])->name('items.history');

});
