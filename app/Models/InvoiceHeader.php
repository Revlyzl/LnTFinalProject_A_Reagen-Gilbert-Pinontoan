<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_address',
        'postal_code',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function invoice_detail(){
        return $this->hasMany(InvoiceDetail::class);
    }
}
