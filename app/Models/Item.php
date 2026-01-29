<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'laba',
        'harga_jual',
        'foto',
        'supplier_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

        public function supplier()
        {
            return $this->belongsTo(Supplier::class);
        }

}
