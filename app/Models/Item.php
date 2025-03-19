<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'user_id', 
        'name', 
        'type', 
        'detail', 
        'size', 
        'category', 
        'product_number', 
        'sale_start_date', 
        'price',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * 商品更新履歴とのリレーション
     */
    public function updateHistories()
    {
        return $this->hasMany(UpdateHistory::class);
    }
}
