<?php

namespace App\Imports;

use App\Models\Item;
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
            'price'       => $row['price'],
            'sale_start_date'=> $row['sale_start_date']
        ]);
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
