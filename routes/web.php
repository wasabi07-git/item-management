<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// 管理者権限のルート
Route::prefix('admin')->name('admin.')->group(function () {
    // 管理者一覧
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // 管理者作成
    Route::get('create', [AdminController::class, 'create'])->name('create');
    Route::post('create', [AdminController::class, 'store'])->name('store');

    // 管理者編集
    Route::get('{admin}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('{admin}', [AdminController::class, 'update'])->name('update');

    // 管理者削除
    Route::delete('{admin}', [AdminController::class, 'destroy'])->name('destroy');

    // 一括削除
    Route::delete('bulk-delete', [AdminController::class, 'bulkDelete'])->name('bulkDelete');
})