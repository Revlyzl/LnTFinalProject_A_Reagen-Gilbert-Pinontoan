<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function invoice_header(){
        return $this->belongsTo(InvoiceHeader::class);
    }
}
