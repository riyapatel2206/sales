<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'grand_total',
        'cgst',
        'sgst',
        'total',
        'status',
        'created_at',
        'updated_at'
    ];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
