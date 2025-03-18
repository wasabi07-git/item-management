<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'changes',
    ];

    /**
     * `UpdateHistory` モデルと `Item` モデルのリレーション
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
