<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\UpdateHistory;
use Maatwebsite\Excel\Facades\Excel; // Excel ファサードのインポート
use App\Imports\ItemsImport; // CSVインポート用

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // 商品名での検索
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 商品番号での検索
        if ($request->has('product_number') && $request->product_number !== '') {
            $query->where('product_number', 'like', '%' . $request->product_number . '%');
        }

        // カテゴリで絞り込み
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }
    
        // タイプで絞り込み
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);            
        }

        // 最小価格の絞り込み
        if ($request->has('min_price') && $request->min_price !== '') {
            $query->where('price', '>=', $request->min_price);            
        }

        // 最大価格の絞り込み
        if ($request->has('max_price') && $request->max_price !== '') {
            $query->where('price', '<=', $request->max_price);            
        }

        // 絞り込み結果を取得
        $items = $query->paginate(10); 
        
        // カテゴリとタイプのリストを取得、nullのカテゴリを除外
        $categories = Item::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->get();

        $types = Item::select('type')->distinct()->get();

        // 結果をビューに渡す
        return view('item.index', compact('items', 'categories', 'types'));
    }

    /**
     * 商品登録フォーム
     */
    public function create()
    {
        return view('item.add');
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $request->validate([
                'name' => 'required|max:100',
                'type' => 'required|in:レディース,メンズ,指定なし',
                'detail' => 'nullable|max:500',
                'size' => 'nullable|string|max:100', 
                'product_number' => 'required|unique:items',  // 商品番号はユニーク
                'sale_start_date' => 'nullable|date',          // 販売開始日
                'price' => 'required|numeric|min:0',           // 価格は数値で0以上
            ]);

            // 商品登録
            Item::create([
                'user_id' => auth()->id(),
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'detail' => $request->input('detail'),
                'size' => $request->input('size'),
                'category' => $request->input('category'),
                'product_number' => $request->input('product_number'),
                'sale_start_date' => $request->input('sale_start_date'),
                'price' => $request->input('price'),
            ]);

            return redirect('/items')->with('success', '商品が登録されました');
        }

        return view('item.add');
    }

    /**
     * 商品詳細ページ
     */
    public function show($id)
    {
        // 商品詳細ページにデータを渡す
        $item = Item::findOrFail($id);

        // 商品の更新履歴を取得
        $histories = $item->updateHistories()->latest()->get();

        return view('item.show', compact('item', 'histories'));
    }

    /**
     * 商品編集ページ
     */
    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    /**
     * 商品情報の更新処理
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'nullable|max:100',
            'detail' => 'nullable|max:500',
            'size' => 'nullable|string|max:100', // サイズのバリデーション
            'color' => 'nullable|string|max:100', // カラーのバリデーション
            'product_number' => 'required|unique:items,product_number,' . $id,   // 商品番号はユニーク
            'sale_start_date' => 'nullable|date',          // 販売開始日
            'price' => 'required|numeric|min:0',           // 価格は数値で0以上
        ]);

        // 商品の更新処理
        $item = Item::findOrFail($id);

        // 変更内容を記録
        $changes = [];

        $attributes = [
            'name' => '商品名',
            'type' => 'タイプ',
            'detail' => '詳細',
            'size' => 'サイズ',
            'category' => 'カテゴリ',
            'product_number' => '商品番号',
            'sale_start_date' => '販売開始日',
            'price' => '価格'
        ];

        foreach ($attributes as $attribute => $label) {
            $oldValue = $item->$attribute;
            $newValue = $request->input($attribute);

            // 値が異なれば変更内容を記録
            if ($oldValue !== $newValue) {
                $changes[] = "{$label}変更: " . $oldValue . " → " . $newValue;
            }
        }

        // 商品情報の更新
        $item->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'detail' => $request->input('detail'),
            'size' => $request->input('size'),
            'category' => $request->input('category'),
            'product_number' => $request->input('product_number'),
            'sale_start_date' => $request->input('sale_start_date'),
            'price' => $request->input('price'),
        ]);

        // 更新履歴を保存
        if (!empty($changes)) {
            UpdateHistory::create([
                'item_id' => $item->id,
                'user_id' => auth()->id(),
                'changes' => implode(", ", $changes),
            ]);
        }

        return redirect()->route('items.index')->with('success', '商品が更新されました');
    }

    /**
     * 商品の更新履歴ページ
     */
    public function history($id)
    {
        // 商品とその更新履歴を取得
        $item = Item::findOrFail($id);
        $histories = $item->updateHistories()->latest()->get();

        // 更新履歴ビューを返す
        return view('item.history', compact('item', 'histories'));
    }

    /**
     * 一括削除処理
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:items,id',
        ]);

        Item::destroy($request->selected_ids);

        return redirect()->route('items.index')->with('success', '選択された商品が削除されました');
    }

    /**
     * インポートフォーム
     */
    public function showImportForm()
    {
        return view('item.import');
    }

    /**
     * CSVデータをインポート
     */
    public function import(Request $request)
    {
        // バリデーション
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // CSVファイルのインポート
        Excel::import(new ItemsImport, $request->file('csv_file'));

        return redirect()->route('items.import')->with('success', '商品データが正常にインポートされました。');
    }
}
