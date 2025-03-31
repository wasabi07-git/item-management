<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ItemsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // バリデーションルールを設定
        $validator = Validator::make($row, [
            'product_number' => 'required|unique:items,product_number', // 商品番号は必須でユニーク
            'name' => 'required|max:100', // 商品名は必須で100文字以内
            'price' => 'required|numeric|min:0', // 価格は必須で数値かつ0以上
            'sale_start_date' => 'nullable|date', // 販売開始日は日付形式
            'type' => 'nullable|max:100', // タイプは任意で100文字以内
            'detail' => 'nullable|max:500', // 詳細は任意で500文字以内
            'category' => 'nullable|max:100', // カテゴリは任意で100文字以内
            'size' => 'nullable|max:100', // サイズは任意で100文字以内
        ]);

        if ($validator->fails()) {
            return null;
        }

        // 既存のデータを取得して更新または新規作成
        return Item::updateOrCreate(
            ['product_number' => $row['product_number']],
            [
                'user_id'        => auth()->id(), 
                'name'           => $row['name'],
                'type'           => $row['type'],
                'detail'         => $row['detail'],
                'size'           => $row['size'],
                'category'       => $row['category'],
                'price'          => $row['price'],
                'sale_start_date'=> $row['sale_start_date']
            ]
        );
    }
    // private function generateProductCode($length = 6)
    // {
    //     do {
    //         // ランダムな大文字アルファベット2文字 + 6桁の数字
    //         $code = strtoupper(Str::random(2)) .'-'. str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    //     } while (Item::where('product_number', $code)->exists()); // ユニークチェック

    //     return $code;
    // }
}
